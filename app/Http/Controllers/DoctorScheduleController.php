<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorSchedule;

class DoctorScheduleController extends Controller
{
    // Show form
    public function create()
    {
        $doctors = Doctor::all();
        return view('adminpenal.addschedule', compact('doctors'));
    }

    // Store schedule
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'available_from' => 'required|date|before_or_equal:available_to',
            'available_to' => 'required|date|after_or_equal:available_from',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'total_slots' => 'required|integer|min:1',
            'is_available' => 'required|boolean',
        ]);

        DoctorSchedule::create([
            'doctor_id' => $request->doctor_id,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_slots' => $request->total_slots,
            'is_available' => $request->is_available,
        ]);

        return redirect()->back()->with('success', 'Doctor schedule added successfully!');
    }

    public function printSchedules()
    {
        $schedules = DoctorSchedule::with('doctor')->latest()->get();
        return view('adminpenal.schedule_print', compact('schedules'));
    }

    public function index()
    {
        $schedules = DoctorSchedule::with('doctor')->orderBy('id', 'asc')->get();;
        return view('adminpenal.schedule', compact('schedules'));
    }

    public function edit($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        $doctors = Doctor::all();

        return view('adminpenal.updateschedule', compact('schedule', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'available_from' => 'required|date|before_or_equal:available_to',
            'available_to' => 'required|date|after_or_equal:available_from',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'total_slots' => 'required|integer|min:1',
            'is_available' => 'required|boolean',
        ]);

        $schedule = DoctorSchedule::findOrFail($id);

        // Recalculate slots
        $calculatedSlots = $this->generateSlots($request->start_time, $request->end_time);

        $schedule->update([
            'doctor_id' => $request->doctor_id,
            'available_from' => $request->available_from,
            'available_to' => $request->available_to,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_slots' => $calculatedSlots,
            'is_available' => $request->is_available,
        ]);

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }

    private function generateSlots($startTime, $endTime)
    {
        $start = strtotime($startTime);
        $end = strtotime($endTime);

        $minutes = ($end - $start) / 60;

        return floor($minutes / 15);
    }
    public function destroy($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Schedule deleted successfully!');
    }


}
