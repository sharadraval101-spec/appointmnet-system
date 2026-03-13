<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Services;
use App\Models\Shedule;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $services = Services::count();
        $schedules = DoctorSchedule::count();
        $appointments = Appointment::count();
        $doctor = Doctor::count();

        return view('adminpenal.dashboard', compact('users','services','schedules','appointments','doctor'));
    }

    public function show()
    {
        return $this->index(); // ensures variables are passed
    }
}
