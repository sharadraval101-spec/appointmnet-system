<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncryptedRedirectController;
use App\Http\Middleware\ValidUser;
use PhpParser\Builder\Function_;


// Route to handle encrypted redirects
Route::get('/go/{token}', [EncryptedRedirectController::class, 'handle'])
    ->where('token', '.*')
    ->name('go.encrypted');

Route::get('service', [UserController::class, 'ServicesView'])->name('service');


//regsiter route
Route::get('register', function () {
    return view('layouts.register');
})->name('register');

// Home route
Route::get('/', function () {
    return view('home');
});

// Home route with name
Route::get('/home', function () {
    return view('home');
})->name('home');

// Login route
Route::get('login', function () {
    return view('layouts.login');
})->name('login');

//Contact Page Route

Route::get('contactUs', function () {
    return view('contactus');
})->name('contactUs');

// Register route
Route::post('Logindata', [UserController::class, 'Logindata'])->Name('Logindata');
Route::post('Registration', [UserController::class, 'Register'])->name('Registration');

// Logout route
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// User Profile routes
Route::get('/userprofile', function () {
    return view('UserProfile');
})->name('userprofile');

// User Profile Edit route
Route::get('/userprofile/edit', function () {
    return view('UserProfileEdit');
})->name('userprofile.edit');


Route::get('/userprofile/edit',[ProfileController::class,'edit'])->name('userprofile.edit');

// User Profile show and edit routes
Route::get('/userprofile/{id}', function ($id) {
    // Assuming you have a User model and you want to fetch user data by ID
    $user = \App\Models\User::findOrFail($id);
    return view('UserProfile', compact('user'));
})->name('userprofile.show');



// adminpanal route
Route::get('adminpanal', [DashboardController::class, 'show'])->name('adminpanal');

Route::get('userdata', function () {
    return view('adminpenal.userdata');
})->name('userdata');

Route::get('userdata', [AdminController::class, 'userdata'])->name('userdata');
Route::get('userdata/print', [AdminController::class, 'print'])->name('userdata.print')->middleware('auth');

// user delete route
Route::delete('users/{id}', [AdminController::class, 'deleteUser'])->name('users.destroy');

// user update routes
Route::get('/updateuser', function () {
    return view('adminpenal.updateUser');
})->name('updateuser');

Route::get('/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [AdminController::class, 'update'])->name('update');


// user Add and store routes
Route::get('addUser', [AdminController::class, 'create'])->name('adduser');
Route::post('addUser', [AdminController::class, 'store'])->name('store');


// forgot password route
Route::get('forgotpassword', function () {
    return view('Layouts.forgotpassword');
})->name('forgotpassword');

Route::get('forgotpassword', [UserController::class, 'getForgetpage'])->name('forgotpassword');

Route::post('/update-password', [UserController::class, 'forgotPassword'])->name('updatepassword');


// Services routes (Admin Panel)
Route::get('services', [ServicesController::class, 'index'])->name('services');
Route::get('services/print', [ServicesController::class, 'printServices'])->name('services.print')->middleware('auth');

Route::get('addServices', [ServicesController::class, 'ShowAddService'])->name('addService');
Route::post('addServices/add', [ServicesController::class, 'addService'])->name('service.store');

Route::get('services/{id}/edit', [ServicesController::class, 'EditService'])->name('services.edit');
Route::put('services/{id}', [ServicesController::class, 'UpdateService'])->name('services.update');

Route::delete('services/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');



//doctor route

Route::get('doctors', function () {
    return view('adminpenal.adddoctor');
})->name('doctors');


Route::get('doctordata', [DoctorController::class, 'index'])->name('doctordata');
Route::get('doctordata/print', [DoctorController::class, 'print'])->name('doctordata.print')->middleware('auth');

Route::get('updateDoctor', [DoctorController::class, 'showdoctor'])->name('updateDoctor');

Route::get('adddoctor', [DoctorController::class, 'create'])->name('adddoctor');
Route::post('adddoctorstore', [DoctorController::class, 'store'])->name('adddoctor.store');

Route::get('doctor/{id}/edit', [DoctorController::class, 'editDoctor'])->name('doctor.edit');
Route::put('doctor/{id}', [DoctorController::class, 'updateDoctor'])->name('doctor.update');

Route::delete('doctor/{id}/destroy', [DoctorController::class, 'destroy'])->name("doctor.destroy");




// Schedule Routs



Route::get('addshedule', [DoctorScheduleController::class, 'create'])->name('addshedule');
Route::post('/admin/schedule/store', [DoctorScheduleController::class, 'store'])->name('schedule.store');
Route::get('/admin/schedule', [DoctorScheduleController::class, 'index'])->name('sheduleData');
Route::get('/admin/schedule/print', [DoctorScheduleController::class, 'printSchedules'])->name('sheduleData.print')->middleware('auth');

Route::get('/schedule/edit/{id}', [DoctorScheduleController::class, 'edit'])->name('schedule.edit');
Route::put('/schedule/update/{id}', [DoctorScheduleController::class, 'update'])->name('schedule.update');

Route::delete('/schedule/delete/{id}', [DoctorScheduleController::class, 'destroy'])->name('schedule.delete');
// dashboard

Route::get('dashboard', [DashboardController::class, 'show'])->name('dashboard');
Route::get('/admin/dashboard', [DashboardController::class, 'index']);



// Doctor Login Routes

// Show login form
Route::get('DoctorLoginForm', [DoctorController::class, 'ShowLoginForm'])
    ->name('DoctorLogin');


// Handle login request
Route::post('/doctor/login', [DoctorController::class, 'login'])
    ->name('doctor.login.post');

// Doctor Dashboard (protected by middleware)
Route::get('/doctor/dashboard', function () {
    return view('adminpenal.DoctorData'); // your dashboard blade file
})->name('doctor.dashboard')->middleware('doctor.auth');

// Doctor Logout
Route::post('/doctor/logout', function (Request $request) {
    Auth::guard('doctor')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('doctor.logout');




Route::middleware('auth')->group(function () {
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});
Route::delete('/appointments/{appointment}', [AppointmentController::class,'destroy'])->name('appointments.destroy');
Route::get('/doctors/{doctor}/schedule', [AppointmentController::class, 'getDoctorSchedule']);

// AJAX to get slots for a doctor on a date
Route::get('/doctors/{doctor}/slots', [AppointmentController::class, 'getSlots'])->name('doctors.slots');

Route::get('/doctor/appointments', [AppointmentController::class, 'ShowAppointments'])
    ->name('doctor.appointments')
    ->middleware('doctor.auth');

    Route::put('/appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])
     ->name('appointments.updateStatus');


Route::get('/doctor/show-appointments', [AppointmentController::class, 'ShowAppointments'])
    ->name('ShowAppointments');
Route::get('/doctor/show-appointments/print', [AppointmentController::class, 'printAppointments'])
    ->name('ShowAppointments.print')->middleware('auth');

Route::post('/admin/appointments/{id}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
Route::post('/admin/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');



Route::get('/appointmentpage',[AppointmentController::class, 'ShowAppointmentForm'])->name('ShowAppointmentForm');




// Profile routes (only for logged-in users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/about', [UserController::class, 'showfeed'])->name('about');
