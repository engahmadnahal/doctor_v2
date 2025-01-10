<?php

namespace App\Http\Controllers;

use App\Helpers\ControllersService;
use App\Helpers\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    public function index()
    {

        $data = User::all();

        return view('cms.patient.admin.index', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:255|unique:users,email',
            'mobile' => 'required|string|max:255|unique:users,mobile',
            'avater' => 'required|image|mimes:png,jpg,jpeg',
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

        return ControllersService::generateProcessResponse($saved, 'CREATE');
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'required|string|max:255|unique:users,mobile,' . $user->id,
            'avater' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if ($validator->fails()) {
            return ControllersService::generateValidationErrorMessage($validator->getMessageBag()->first());
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if ($request->hasFile('avater')) {
            $user->avater = $this->uploadFile($request->file('avater'), 'users');
        }
        $saved =  $user->save();

        return ControllersService::generateProcessResponse($saved, 'UPDATE');
    }

    public function destroy(User $user)
    {
        $deleted = $user->delete();

        return response()->json([
            'status' => $deleted,
            'message' => Messages::getMessage('SUCCESS'),
        ], Response::HTTP_OK);
    }
}
