<?php

namespace App\Http\Controllers;

use App\Models\ClinicalRecords;
use App\Util\Util;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClinicalRecordsController extends Controller
{
    public function formView()
    {
        return view('clinicalRecordsView');
    }

    public function getClinicalRecords()
    {
        $clinicalRecords = ClinicalRecords::all();
        return response()->json(['status' => true, 'clinicalRecords' => $clinicalRecords]);
    }

    public function generatePDF(Request $request)
    {
        set_time_limit(0);
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'rut' => 'required',
            'age' => 'required|integer',
            'phone' => ['required', 'min:8'],
            'name_provider' => 'required',
            'rut_provider' => 'required',
            'registration_number' => 'required',
            'signature' => 'required',
        ]);

        $validator->setAttributeNames([
            'name' => 'Nombre',
            'rut' => 'RUT',
            'age' => 'Edad',
            'name_provider' => 'Nombre de Prestador',
            'rut_provider' => 'Rut de Prestador',
            'registration_number' => 'N° de Registro',
            'signature' => 'Firma',
            'phone' => 'Número Telefónico'
        ]);

        $phone = $request->input('phone');
        $formattedPhone = Util::formatChileanPhone($phone);

        $dateInput = $request->input('date') ?? now('America/Santiago')->format('Y-m-d');

        if (preg_match('/\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}/', $dateInput)) {
            // viene desde form vue
            $date = Carbon::parse($dateInput, 'UTC')->setTimezone('America/Santiago');
        } else {
            // viene desde form laravel
            $date = Carbon::createFromFormat('Y-m-d', $dateInput, 'America/Santiago');
        }

        $formattedDate = $date->format('d/m/Y'); // formato para mostrar
        $timestamp = $date->timestamp; // formato para guardar y manipular

        if ($validator->fails()) return response()->json(['status' => false, 'error' => $validator->errors()->first()], 422);

        $lastRecord = ClinicalRecords::orderBy('number', 'desc')->first();

        $number = $lastRecord ? $lastRecord->number + 1 : 1;
        $data['number'] = $number;

        $clinicalRecords = new ClinicalRecords();
        $clinicalRecords->name = $request['name'];
        $clinicalRecords->rut = $request['rut'];
        $clinicalRecords->age = $request['age'];
        $clinicalRecords->phone = $formattedPhone;
        $clinicalRecords->responsible_family_member = isset($$request['responsible_family_member']) && $request['responsible_family_member'] ? $request['responsible_family_member'] : 'No posee';
        $clinicalRecords->number = $number;
        $clinicalRecords->date = $timestamp;
        $clinicalRecords->older_adults = isset($request['older_adults']) && $request['older_adults'] ? $request['older_adults'] : 0;
        $clinicalRecords->minor_adults = isset($request['minor_adults']) && $request['minor_adults'] ? $request['minor_adults'] : 0;
        $clinicalRecords->children = isset($request['children']) && $request['children'] ? $request['children'] : 0;
        $clinicalRecords->medications = isset($request['medications']) && $request['medications'] ? $request['medications'] : 'No posee';
        $clinicalRecords->health_history = isset($request['health_history']) && $request['health_history'] ? $request['health_history'] : 'No posee';
        $clinicalRecords->reason = isset($request['reason']) && $request['reason'] ? $request['reason'] : 'No posee';
        $clinicalRecords->anamnesis = isset($request['anamnesis']) && $request['anamnesis'] ? $request['anamnesis'] : 'No posee';
        $clinicalRecords->physical_examination = isset($request['physical_examination']) && $request['physical_examination'] ? $request['physical_examination'] : 'No posee';
        $clinicalRecords->diagnosis = isset($request['diagnosis']) && $request['diagnosis'] ? $request['diagnosis'] : 'No posee';
        $clinicalRecords->indications = isset($request['indications']) && $request['indications'] ? $request['indications'] : 'No posee';
        $clinicalRecords->others = isset($request['others']) && $request['others'] ? $request['others'] : 'No posee';
        $clinicalRecords->name_provider = $request['name_provider'];
        $clinicalRecords->rut_provider = $request['rut_provider'];
        $clinicalRecords->registration_number = $request['registration_number'];
        $clinicalRecords->signature = $request['signature'];
        $clinicalRecords->pdf_data = json_encode($data);
        $clinicalRecords->provider_id = isset($request['provider']) ? $request['provider'] : 1;
        $clinicalRecords->patient_id = isset($request['patient']) ? $request['patient'] : 1;
        $clinicalRecords->created_by = Auth::user() ? Auth::user()->id : 1;
        $clinicalRecords->save();

        $clinicalRecords->date = $formattedDate;
        $pdf = Pdf::loadView('pdf.clinicalRecord', ['data' => $clinicalRecords]);

        return $pdf->download('clinical_record.pdf');
    }

    public function downloadPDF($idClinicalRecords)
    {
        try {
            $clinicalRecords = ClinicalRecords::findOrFail($idClinicalRecords);

            $pdfData = json_decode($clinicalRecords->pdf_data, true);

            if (!$pdfData) {
                return response()->json([
                    'message' => 'Error al decodificar los datos del PDF'
                ], 400);
            }

            $pdf = Pdf::loadView('pdf.clinicalRecord', ['data' => $pdfData]);

            return $pdf->download('Ficha Clínica #' . $clinicalRecords->number . '.pdf');
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al generar el PDF',
                'status' => false
            ], 500);
        }
    }
}
