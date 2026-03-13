<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Mail\AppointmentStatusMail;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments
     */
    public function index()
    {
        $appointments = Appointment::with('doctor')->latest()->paginate(12);
        $doctors = Doctor::all();

        return view('appointment', compact('appointments', 'doctors'));
    }

    /**
     * Show the form for creating a new appointment
     */

    public function ShowAppointmentForm()
    {
        // $doctors = Doctor::orderBy('name',)->get();
        $doctors =Doctor::orderByRaw('name')->get();
        return view('admin', compact('doctors'));
    }
    // public function ShowAppointments()
    // {
    //     $doctorId = session('id');

    //     if (!$doctorId) {
    //         return redirect()->route('doctor.login')->with('error', 'Please login first.');
    //     }

    //     $appointments = Appointment::with('doctor')
    //         ->where('doctor_id', $doctorId)
    //         ->get();

    //     return view('adminpenal.appointments', compact('appointments'));
    // }


    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // update status from the hidden input
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully!');
    }


    public function create()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('appointments.create', compact('doctors'));
    }


    public function getDoctorSchedule(Doctor $doctor)
    {
        $schedule = DoctorSchedule::where('doctor_id', $doctor->id)
            ->where('is_available', true)
            ->orderBy('available_from', 'asc')
            ->first();

        if (!$schedule) {
            return response()->json(['status' => 'no_schedule']);
        }

        return response()->json([
            'status' => 'ok',
            'available_from' => $schedule->available_from,
            'available_to' => $schedule->available_to,
        ]);
    }


    /**
     * Store a newly created appointment
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required|exists:doctors,id',
            'patientName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:30',
            'gender' => 'nullable|string',
            'age' => 'nullable|integer|min:0|max:120',
            'appointmentDate' => 'required|date',
            'appointmentTime' => 'required',
            'concern' => 'nullable|string',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $doctorId = $request->input('doctor');
        $date = $request->input('appointmentDate');
        $time = $request->input('appointmentTime');

        $schedule = DoctorSchedule::where('doctor_id', $doctorId)
            ->whereDate('available_from', '<=', $date)
            ->whereDate('available_to', '>=', $date)
            ->where('is_available', true)
            ->first();

        if (!$schedule) {
            return back()->withInput()->withErrors([
                'appointmentDate' => 'Selected doctor is not available on this date.'
            ]);
        }

        $slots = $this->generateSlotsFromSchedule($schedule);

        $booked = Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(fn($t) => substr($t, 0, 5))
            ->toArray();

        $availableSlots = array_values(array_diff($slots, $booked));

        $timeNormalized = substr($time, 0, 5);

        if (!in_array($timeNormalized, $availableSlots)) {
            return back()->withInput()->withErrors([
                'appointmentTime' => 'Selected time is no longer available. Please choose another slot.'
            ]);
        }

        $uploaded = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('public/appointments');
                $uploaded[] = basename($path);
            }
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'doctor_id' => $doctorId,
            'patient_name' => $request->input('patientName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'appointment_date' => $date,
            'appointment_time' => $timeNormalized . ':00',
            'concern' => $request->input('concern'),
            'documents' => $uploaded,
        ]);
        return redirect()->route('home')
            ->with('success', 'Appointment booked successfully!');

    }

    /**
     * Show the form for editing the specified appointment
     */
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    /**
     * Update the specified appointment
     */

    /**
     * Remove the specified appointment
     */
    public function destroy(Appointment $appointment)
    {
        if (Auth::id() !== $appointment->user_id) {
            return redirect()->route('profile')->with('error', 'You are not authorized to delete this appointment.');
        }

        if ($appointment->documents) {
            foreach ($appointment->documents as $file) {
                $path = 'public/appointments/' . $file;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }
        }

        $appointment->delete();
        return redirect()->route('profile')
            ->with('success', 'Appointment deleted successfully.');
    }

    /**
     * Get available slots for a doctor on a given date (AJAX)
     */
    public function getSlots(Request $request, Doctor $doctor)
    {
        $date = $request->query('date');
        if (!$date) {
            return response()->json(['status' => 'error', 'message' => 'Date is required'], 400);
        }

        $schedule = DoctorSchedule::where('doctor_id', $doctor->id)
            ->whereDate('available_from', '<=', $date)
            ->whereDate('available_to', '>=', $date)
            ->where('is_available', true)
            ->first();

        if (!$schedule) {
            return response()->json(['status' => 'no_schedule'], 200);
        }

        $slots = $this->generateSlotsFromSchedule($schedule);

        $booked = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(fn($t) => substr($t, 0, 5))
            ->toArray();

        $available = array_values(array_diff($slots, $booked));

        if (empty($available)) {
            return response()->json(['status' => 'no_slots'], 200);
        }

        return response()->json(['status' => 'ok', 'slots' => $available], 200);
    }

    /**
     * Generate time slots based on doctor's schedule
     */
    protected function generateSlotsFromSchedule(DoctorSchedule $schedule): array
    {
        $start = Carbon::createFromFormat('H:i:s', $schedule->start_time ?? '00:00:00');
        $end = Carbon::createFromFormat('H:i:s', $schedule->end_time ?? '23:59:59');
        $duration = intval($schedule->slot_duration) ?: 30;

        $slots = [];
        $current = $start->copy();

        while ($current->lessThan($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($duration);
        }

        if ($schedule->total_slots && count($slots) > $schedule->total_slots) {
            $slots = array_slice($slots, 0, $schedule->total_slots);
        }

        return $slots;
    }

    public function ShowAppointments()
    {
        // Ensure doctor is logged in
        $doctorId = Session::get('id');

        $appointments = Appointment::with('doctor')->orderBy('id', 'asc')->get();

        // Load the Blade view
        return view('adminpenal.ShowAppointments', compact('appointments'));
    }


    public function printAppointments()
    {
        $appointments = Appointment::with('doctor')->orderBy('id', 'desc')->get();
        return view('adminpenal.ShowAppointments_print', compact('appointments'));
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        $message = "Your appointment has been approved by Dr. " . ($appointment->doctor->name ?? 'Doctor') . ".";
        Mail::to($appointment->email ?? $appointment->email)->send(new AppointmentStatusMail($appointment, $message));

        return response()->json(['success' => 'Appointment Approved & Email Sent']);
    }

    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'cancelled';
        $appointment->save();

        $message = "Your appointment has been cancelled by Dr. " . ($appointment->doctor->name ?? 'Doctor') . ".";
        Mail::to($appointment->email ?? $appointment->email)->send(new AppointmentStatusMail($appointment, $message));

        return response()->json(['success' => 'Appointment Cancelled & Email Sent']);
    }
}
