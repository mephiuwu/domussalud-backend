<?php

namespace App\Http\Controllers;

use App\Models\ProviderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProvidersController extends Controller
{
    public function getProviders()
    {
        try {
            $providers = User::getUser('provider');
            return response()->json(['status' => true, 'providers' => $providers]);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return response()->json(['status' => false]);
        }
    }

    public function createProviders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', 
            'lastName' => 'required|string|max:255', 
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'rut' => 'required|string|max:12|unique:users,rut', 
            'profession' => 'required|string|max:255', 
            'occupation' => 'required|string|max:255', 
            'birthdate' => 'required', 
            'gender' => 'required|string',   
            'marital_status' => 'required|string', 
            'address' => 'required',
            'id_card' => 'required|file|mimes:pdf',
            'account_verified' => 'required|boolean', 
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $rut = $request->rut;
            $directoryPath = "public/$rut";

            if (!Storage::exists($directoryPath)) {
                Storage::makeDirectory($directoryPath);
            }

            
            if ($request->hasFile('id_card')) {
                $idCardPath = $request->file('id_card')->storeAs($directoryPath, 'ci.pdf');
            }

            $address = json_decode($request->input('address'), true);

            $user = new User();
            $user->first_name = $request->input('name');
            $user->last_name = $request->input('lastName');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->phone = $request->input('phone');
            $user->profession = $request->input('profession');
            $user->occupation = $request->input('occupation');
            $user->rut = $request->input('rut');
            $user->address = json_encode($address);
            $user->marital_status = $request->input('marital_status');
            $user->gender = $request->input('gender');
            $user->account_verified = $request->input('account_verified');
            $user->birthdate = $request->input('birthdate');
            $user->verified_at = time();
            $user->is_active = $request->input('is_active');
            $user->role = 'provider';
            $user->save();

            $providersDetails = new ProviderDetail();
            $providersDetails->registration_number = null;
            $providersDetails->license_number = null;
            $providersDetails->id_card = $idCardPath;
            $providersDetails->certificate_criminal_record = null;
            $providersDetails->signature = null;
            $providersDetails->user_id = $user->id;
            $providersDetails->save();

            dd();
            return response()->json([
                'success' => true,
                'message' => 'Prestador creado con éxito',
                'data' => $user,
            ], 201);
            
        } catch (\Throwable $th) {
            Log::error('Error al crear Prestador: ' . $th->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al crear el Prestador',
            ], 500);
        }
    }
}
