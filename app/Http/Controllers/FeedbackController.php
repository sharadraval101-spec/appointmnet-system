<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'date' => 'required|date',
            'feedback' => 'required|string',
        ]);

        Feedback::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date' => $request->date,
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('contactUs')->with('success', 'Thank you for your feedback!');
    }

    public function showfeed()
    {
        $feedback=Feedback::all();
        dd($feedback);
        return view('service',compact('feedback'));
    }
}
