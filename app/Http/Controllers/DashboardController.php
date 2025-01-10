<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ContactUs;
use App\Models\Delivary;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\Product;
use App\Models\ServiceStudio;
use App\Models\StoreHouse;
use App\Models\Studio;
use App\Models\StudioBranch;
use App\Models\StudioService;
use App\Models\User;
use App\Models\UserDoctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DashboardController extends Controller
{

    public function index()
    {
        if (auth('admin')->check()) {

            return $this->admin();
        }

        if (auth('doctor')->check()) {

            return $this->doctor();
        }

        return $this->user();
    }

    private function doctor()
    {

        $appointments = Appointment::where('doctor_id', auth('doctor')->user()->id)->get();
        $users = UserDoctor::where('doctor_id', auth('doctor')->user()->id)->count();

        return response()->view('cms.dashboard', [
            'appointments' => $appointments,
            'users' => $users
        ]);
    }


    private function user()
    {
        $doctors = Doctor::whereHas('users', function ($q) {
            $q->where('user_id', auth('user')->user()->id);
        })->get();

        return response()->view('cms.dashboard', [
            'doctors' => $doctors
        ]);
    }


    private function admin()
    {

        $doctors = Doctor::count();
        $users = User::count();
        $appointments = Appointment::get();

        return response()->view('cms.dashboard', [
            'doctors' => $doctors,
            'users' => $users,
            'appointments' => $appointments,
        ]);
    }
}
