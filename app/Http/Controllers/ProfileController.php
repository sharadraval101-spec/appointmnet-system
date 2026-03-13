<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class ProfileController extends Controller
{
    // Show profile page
    public function index()
    {
        $user = Auth::user();

        $appointments = Appointment::with('doctor')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('UserProfile', compact('appointments'));
    }

    // Edit profile page
    public function edit()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile'), $imageName);
            $user->profile_image = 'uploads/profile/' . $imageName;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
