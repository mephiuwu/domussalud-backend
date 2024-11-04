<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        try {
            Log::debug($request);
            $address = $request->input('address');
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return response()->json(['status' => false]);
        }
    }
}
