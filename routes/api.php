<?php

use App\Http\Controllers\AdministratorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicalRecordsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ProvidersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);

Route::get('/administrators', [AdministratorsController::class , 'getAdministrators']);
Route::post('/administrators/create', [AdministratorsController::class , 'createAdministrators']);

Route::get('/clinical-records', [ClinicalRecordsController::class, 'getClinicalRecords']);
Route::get('/clinical-records/{id_clinical_records}/download', [ClinicalRecordsController::class, 'downloadPDF']);

Route::get('/patients', [PatientsController::class, 'getPatients']);

Route::get('/providers', [ProvidersController::class, 'getProviders']);
Route::post('/providers/create', [ProvidersController::class, 'createProviders']);

Route::middleware('auth:api')->group(function () {
    Route::post('/clinical-record/generate/pdf', [ClinicalRecordsController::class, 'generatePDF']);
});
