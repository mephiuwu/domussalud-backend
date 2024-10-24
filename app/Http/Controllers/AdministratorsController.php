<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdministratorsController extends Controller
{
    public function getAdministrators()
    {
        $administrators = User::getAdministrators();
        return response()->json($administrators);
    }

    public function createAdministrators(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'rut' => 'required|string|max:12|unique:users,rut',
            'date_of_birth' => 'required|date',
            'password' => 'required|string|min:8',
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $administrator = new User([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'rut' => $request->input('rut'),
                'date_of_birth' => $request->input('date_of_birth'),
                'password' => Hash::make($request->input('password')),
                'account_verified' => true,
                'is_active' => $request->input('is_active'),
                'user_type' => 'admin'
            ]);

            $administrator->save();

            Log::debug('Administrador creado:', $request->all());

            return response()->json([
                'success' => true,
                'message' => 'Administrador creado exitosamente',
                'administrator' => $administrator,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error al crear administrador: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al crear el administrador',
            ], 500);
        }
    }
}
