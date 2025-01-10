<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class PatientController extends Controller
{


    public function index()
    {

        $data = User::whereHas('doctor', function ($q) {
            $q->where('doctor_id', auth('doctor')->user()->id);
        })->get();

        return view('cms.patient.doctor.index', ['data' => $data]);
    }

    public function getReportUserData(User $user)
    {

        $userFolder = storage_path("app/temp/{$user->name}");
        if (!file_exists($userFolder)) {
            mkdir($userFolder, 0777, true);
        }

        $userData = "Username: {$user->name}\n";
        $userData .= "Email: {$user->email}\n";
        $userData .= "Mobile: {$user->mobile}\n";

        file_put_contents("{$userFolder}/user_data.txt", $userData);

        $files = $user->files; // Assuming `images` is a relationship or array of paths
        foreach ($files as $index => $row) {
            $imageContent = Storage::get($row->file);
            $imageName = "file_" . ($index + 1) . "." . pathinfo($row->file, PATHINFO_EXTENSION);
            file_put_contents("{$userFolder}/{$imageName}", $imageContent);
        }

        $zipPath = storage_path("app/temp/{$user->name}.zip");
        $zip = new ZipArchive();
        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            $files = scandir($userFolder);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $zip->addFile("{$userFolder}/{$file}", $file);
                }
            }
            $zip->close();
        }

        // Clean up temporary folder
        foreach (scandir($userFolder) as $file) {
            if ($file != '.' && $file != '..') {
                unlink("{$userFolder}/{$file}");
            }
        }
        rmdir($userFolder);

        // Download the ZIP file
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}
