<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function getPatients() {
        try {
            $patients = User::getUser('patient');
            return response()->json(['status' => true, 'patients' => $patients]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
        }
    }
}
