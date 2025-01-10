<?php

namespace App\Http\Controllers\Doctor;

use App\Helpers\ControllersService;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Notifications\AcceptAppointmentNotification;
use App\Notifications\RejectAppointmentNotification;
use Dotenv\Validator;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        $data = Appointment::where('doctor_id', auth('doctor')->user()->id)->get();

        return view('cms.appointments.doctor.index', [
            'data' => $data
        ]);
    }


    public function accept(Request $request)
    {
        $validator = Validator($request->all(), [
            'appointment_id' => 'required|integer|exists:appointments,id,status,pending',
            'note' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
        
        $appointment = Appointment::find($request->appointment_id);
        $appointment->status = 'accept';
        $appointment->note = $request->note;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $saved = $appointment->save();

        if ($saved) {
            $user = User::find($appointment->user_id);
            $user->notify(new AcceptAppointmentNotification($appointment?->doctor?->name));
        }

        return ControllersService::generateProcessResponse($saved, 'UPDATE');
    }


    public function reject(Request $request)
    {
        $validator = Validator($request->all(), [
            'appointment_id' => 'required|integer|exists:appointments,id,status,pending',
            'reason' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }
      
        $appointment = Appointment::find($request->appointment_id);
        $appointment->status = 'reject';
        $appointment->reject_reason = $request->reason;
        $saved = $appointment->save();

        if ($saved) {
            $user = User::find($appointment->user_id);
            $user->notify(new RejectAppointmentNotification($appointment?->doctor?->name));
        }

        return ControllersService::generateProcessResponse($saved, 'UPDATE');
    }
}
