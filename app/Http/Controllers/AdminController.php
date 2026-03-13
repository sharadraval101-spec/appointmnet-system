<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // display all users
    public function userdata()
    { 
        $users = User::where('role', 'user')->get();
        return view('adminpenal.userdata', compact('users'));
    }

    public function print()
    {
        $users = User::where('role', 'user')->get();
        return view('adminpenal.userdata_print', compact('users'));
    }

    // delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('userdata')->with('success', 'User deleted successfully!');
    }

    // edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('adminpenal.updateuser', compact('user'));
    }

    // update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully!');

        // return redirect()->route('userdata')->with('success', 'User updated successfully!');
    }

    // Show Add User Form
    public function create()
    {
        return view('adminpenal.addUser');
    }

    // Store New User
    public function store(Request $request)
    {
        $request->validate([
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
            // 'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        // If you want to set default password for demo
        // $user->password = bcrypt('password123');

        // Image Upload (Optional)
        /*
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $user->image = $imageName;
        }
        */

        $user->save();
        return redirect()->route('adduser')->with('success', 'User added successfully!');
    }

}
