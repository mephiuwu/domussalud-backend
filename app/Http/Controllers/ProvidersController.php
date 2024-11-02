<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProvidersController extends Controller
{
    public function getProviders() {
        try {
            Log::debug('xd');
            $providers = User::getUser('provider');
            Log::debug($providers);
            Log::debug(2);
            return response()->json(['status' => true, 'providers' => $providers]);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return response()->json(['status' => false]);
        }
    }
}
