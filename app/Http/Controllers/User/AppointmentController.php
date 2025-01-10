<?php

namespace App\Http\Controllers\User;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Notifications\BookingAppointmentNotification;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{


    public function index()
    {

        $appointments = Appointment::where('user_id', auth('user')->user()->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Appointment Data',
            'data' => AppointmentResource::collection($appointments)
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'doctor_id' => 'required|integer|exists:doctors,id',
            'reason_appoitment' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf'
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $appointment = new Appointment;
        $appointment->reason_appoitment = $request->reason_appoitment;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->user_id = auth('user')->user()->id;
        $appointment->file = $this->uploadFile($request->file('file'), 'appointments');
        $saved = $appointment->save();

        if ($saved) {
            $doctor = Doctor::whereId($request->doctor_id)->first();
            $doctor->notify(new BookingAppointmentNotification(auth('user')->user()->name));
        }

        return ControllersService::generateProcessResponse($saved, 'UPDATE');
    }
}
