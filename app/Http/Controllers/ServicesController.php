<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\services;
use App\Models\Feedback;
use Illuminate\Support\Facades\Redirect;

class ServicesController extends Controller
{
    public function printServices()
    {
        $services = services::all();
        return view('adminpenal.services_print', compact('services'));
    }

    public function index()
    {
        $services = services::all();
        return view('adminpenal.services', compact('services'));
    }

    public function ShowAddService()
    {
        return view('adminpenal.addservices');
    }

    public function addService(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'service_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('service_image')) {
            $imageName = time() . '.' . $request->service_image->extension();
            $request->service_image->move(public_path('assets'), $imageName);
        }

        Services::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'service_image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Service added successfully !!');
        // return redirect()->route('services')->with('success', 'Service added successfully !!');
    }


    public function EditService($id)
    {
        $service = services::findOrFail($id);
        return view('adminpenal.updateservices', compact('service'));
        // return Redirect()->route('services.edit',compact('service'));
    }
    public function UpdateService(Request $request, $id)
    {
        $service = services::findOrFail($id);

        $request->validate([
            'service_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'service_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('service_image')) {
            $imageName = time() . '.' . $request->service_image->extension();
            $request->service_image->move(public_path('assets'), $imageName);
        } else {
            $imageName = $service->service_image; // Keep the old image if no new image is uploaded
        }

        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->service_image = $imageName;
        $service->save();
        return redirect()->back()->with('success', 'Service updated successfully!');
        // return redirect()->route('services')->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = services::findOrFail($id);
        $service->delete();

        return redirect()->route('services')->with('success', 'Service deleted successfully.');
    }
}
