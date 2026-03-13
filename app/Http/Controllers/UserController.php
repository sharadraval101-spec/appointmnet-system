<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\services;
use App\Models\Feedback;
use App\Models\Doctor;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;

class UserController extends Controller
{
    // register user
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('validation_error', $validator->errors()->first());
        }

        $data = $validator->validated();

        $user = User::create($data);
        if ($user) {
            return redirect()->route('login')->with('register_success', 'Registration successful! Please log in.');
        } else {
            return redirect()->route('register')->with('register_failed', 'Something went wrong. Please try again.');
        }

    }

    // login user
    public function Logindata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        // user login validation

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('validation_error', $validator->errors()->first());
        }

        $data = $validator->validated();

        if (Auth::attempt($data)) {

            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('adminpanal')->with('success', 'Admin login successful!');
            } else {
                return redirect()->route('home')->with('success', 'User login successful!');
            }
        } else {
            return redirect()->back()
                ->with('login_failed', 'Login failed !!')
                ->withInput();
        }


    }

    public function getForgetpage()
    {
        $user = Auth::user();
        return view('Layouts.forgotpassword',compact('user'));
    }

    // forget password
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirmed',
            ],

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', $validator->errors()->first());
        }


        $data = $validator->validated();

        $user = User::where('email', $data['email'])->first();
        // dd($user);
        if ($user) {
            $user->password = Hash::make($data['password']);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->with('error', 'User not found. Please check your email.');
        }

    }

    public function ServicesView()
    {
        $services = services::all();
         $feedback=Feedback::all();
        return view('service', compact('services','feedback'));
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('adminpanal');
        }
        if ($user->role === 'doctor') {
            // return redirect()->route('') // Define the doctor dashboard route;
        }
        return redirect()->route('user.dashboard');
    }

public function Profile()
    {
        $user = Auth::user();

        $appointments = Appointment::where('id', $user->id)
                            ->orderBy('date', 'desc')
                            ->get();

        return view('UserProfile', compact('appointments'));
    }

     public function update(Request $request)
    {
        $user = Auth::user();

        // Validate inputs
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Update name & email
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {

            // Save new file
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile_images', $filename);

            // Save filename in database
            $user->profile_image = 'profile_images/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
     public function showfeed()
    {
        $doctors=Doctor::all();
        return view('aboutus',compact('doctors'));
    }
}
