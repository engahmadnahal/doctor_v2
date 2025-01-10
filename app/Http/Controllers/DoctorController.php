<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Mail\SuccessRegister;
use App\Models\City;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Region;
use App\Models\Specialty;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        $specialties = Specialty::where('status', true)->get();

        return view('cms.doctors.index', ['data' => $doctors, 'specialties' => $specialties]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator($request->all(), [
            'specialty_id' => 'required|integer|exists:specialties,id,status,1',
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:255|unique:doctors,email,' . $doctor->id,
            'mobile' => 'required|string|max:255|unique:doctors,mobile,' . $doctor->id,
            'address' => 'required|string|max:255',
            'avater' => 'nullable|image|mimes:png,jpg,jpeg',
            'certificate' => 'nullable|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $doctor->specialty_id = $request->specialty_id;
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->mobile = $request->mobile;
        $doctor->address = $request->address;

        if ($request->hasFile('avater')) {
            $doctor->avater = $this->uploadFile($request->file('avater'), 'doctors');
        }

        if ($request->hasFile('certificate')) {
            $doctor->certificate = $this->uploadFile($request->file('certificate'), 'doctors/certificate');
        }
        $saved =  $doctor->save();

        return ControllersService::generateProcessResponse($saved, 'UPDATE');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $deleted = $doctor->delete();

        return response()->json([
            'status' => $deleted,
            'message' => Messages::getMessage('SUCCESS'),
        ], Response::HTTP_OK);
    }
}
