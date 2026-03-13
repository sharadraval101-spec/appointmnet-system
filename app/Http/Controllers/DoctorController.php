<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Dotenv\Validator;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctors = Doctor::all();
        return view('adminpenal.DoctorData', compact('doctors'));
        // return response()->json($doctors);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpenal.adddoctor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:doctors',
            'password' => 'required|string|min:8',
            'specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'active' => 'nullable|boolean',
            // 'deactive' => 'nullable|boolean',
        ]);



        $imageName = null;
        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('assets'), $imageName);
        }

        Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'specialization' => $request->specialization,
            'qualification' => $request->qualification,
            'experience' => $request->experience,
            'description' => $request->description,
            'phone' => $request->phone,
            'profile_image' => $imageName,
            // 'active' => $request->active,
            // 'deactive' => $request->deactive,
        ]);
        return redirect()->route('doctordata')->with('success', 'Doctor Added successfully');

    }

    public function print()
    {
        $doctors = Doctor::all();
        return view('adminpenal.DoctorData_print', compact('doctors'));
    }

    /**
     * Display the specified resource.
     */
    public function showdoctor()
    {
        return view('adminpenal.updatedoctor');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('adminpenal.updatedoctor', compact('doctor'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'password' => 'nullable|min:6',
            'specialization' => 'nullable|string',
            'qualification' => 'nullable|string',
            'experience' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:active,inactive',
            'profile_image' => 'nullable|image|max:2048',
        ]);


        $imageName = null;
        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('assets'), $imageName);
        }

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->password = bcrypt($request->password);
        $doctor->specialization = $request->specialization;
        $doctor->qualification = $request->qualification;
        $doctor->experience = $request->experience;
        $doctor->description = $request->description;
        $doctor->phone = $request->phone;
        // $doctor->status= $request->status;
        $doctor->profile_image = $imageName;
        $doctor->save();


        // $doctor->update($validated);

        return redirect()->back()->with('success', 'Doctor updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();

        return redirect()->back()->with('success', 'Doctor Deleted Succesfully !!');
    }

    // login doctor

    public function ShowLoginForm()
    {
        return view('Layouts.DoctorLogin');
    }
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email|unique:users,email',
    //         'password' => [
    //             'required',
    //             'string',
    //             'min:8',
    //             'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
    //         ],
    //     ]);

    //     $doctor = Doctor::where('email', $request->email)->first();

    //     if ($doctor && Hash::check($request->password, $doctor->password)) {
    //         // Store doctor session
    //         Session::put('id', $doctor->id);
    //         Session::put('name', $doctor->name);

    //         return redirect()->route('sheduleData')->with('success', 'Welcome Dr. ' . $doctor->name . '!');
    //     } else {
    //         return back()->with('error', 'Invalid email or password.');
    //     }
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $doctor = Doctor::where('email', $request->email)->first();
        // dd($doctor);
        // if ($doctor && Hash::check($request->password, $doctor->password)) {
        //     return redirect()
        //         ->route('sheduleData')
        //         ->with('success', 'Welcome Dr. ' . $doctor->name . '!');
        // }

        if ($doctor) {
            Auth::guard('doctor')->login($doctor);
            # code...
            return redirect()
                ->route('sheduleData')
                ->with('success', 'Welcome Dr. ' . $doctor->name . '!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

}
