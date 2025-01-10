<?php

namespace App\Http\Controllers\User;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Mail\SuccessRegister;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use App\Models\UserDoctor;
use App\Models\UserMedia;
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

        return view('cms.auth.user.register', [
            'specialties' => $specialties
        ]);
    }

    public function successUserRegister()
    {
        return view('cms.auth.user.success_register');
    }


    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:255|unique:users,email',
            'mobile' => 'required|string|max:255|unique:users,mobile',
            'avater' => 'required|image|mimes:png,jpg,jpeg',
            'files' => 'required',
            'files.*' => 'required|file|mimes:pdf',
            'doctors' => 'required|array',
            'doctors.*' => 'required|integer|exists:doctors,id',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
       
        $user = new User();
        $user->auth_number = mt_rand(1000000, 9999999);
        $user->password = Hash::make('password');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->avater = $this->uploadFile($request->file('avater'), 'users');
        $saved =  $user->save();

        if ($saved) {

            $insertData = [];
            foreach ($request->file('files') as $file) {
                $insertData[] = [
                    'file' => $this->uploadFile($file, 'media'),
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $doctorData = [];
            foreach ($request->input('doctors') as $doctorId) {
                $doctorData[] = [
                    'user_id' => $user->id,
                    'doctor_id' => $doctorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            if ($insertData) {
                UserMedia::insert($insertData);
            }

            if ($doctorData) {
                UserDoctor::insert($doctorData);
            }

            try {

                Mail::to($user)
                    ->send(new SuccessRegister($user->email, $user->password, $user->auth_number, $user->name));
            } catch (Exception $e) {
            }
        }

        return ControllersService::generateProcessResponse($saved, 'CREATE');
    }
}
