<?php

namespace App\Http\Controllers\Doctor;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Mail\SuccessRegister;
use App\Models\Doctor;
use App\Models\Specialty;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{


    public function index()
    {
        $specialties = Specialty::where('status', true)->get();

        return view('cms.auth.doctor.register', [
            'specialties' => $specialties
        ]);
    }

    public function successRegister()
    {
        return view('cms.auth.doctor.success_register');
    }


    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'specialty_id' => 'required|integer|exists:specialties,id,status,1',
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:255|unique:doctors,email',
            'mobile' => 'required|string|max:255|unique:doctors,mobile',
            'address' => 'required|string|max:255',
            'avater' => 'required|image|mimes:png,jpg,jpeg',
            'certificate' => 'required|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $doctor = new Doctor();
        $doctor->auth_number = mt_rand(1000000, 9999999);
        $doctor->password = Hash::make('password');
        $doctor->specialty_id = $request->specialty_id;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->mobile = $request->mobile;
        $doctor->address = $request->address;
        $doctor->avater = $this->uploadFile($request->file('avater'), 'doctors');
        $doctor->certificate = $this->uploadFile($request->file('certificate'), 'doctors/certificate');
        $saved =  $doctor->save();

        if ($saved) {
            try {

                Mail::to($doctor)
                    ->send(new SuccessRegister($doctor->email, $doctor->password, $doctor->auth_number, $doctor->name));
            } catch (Exception $e) {
            }
        }

        return ControllersService::generateProcessResponse($saved, 'CREATE');
    }
}
