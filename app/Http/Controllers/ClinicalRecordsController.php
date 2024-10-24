<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ClinicalRecordsController extends Controller
{
    public function formView() {
        return view('clinicalRecordsView');
    }

    public function generatePDF(Request $request) {
        set_time_limit(0);
        $data = $request->all();

        $data = [
            'name_patient' => 'Juan Pérez',
            'rut_patient' => '12.345.678-9',
            'age' => 45,
            'phone' => '+56912345678',
            'responsible_family_member' => 'Ana Pérez',
            'date' => now()->format('Y-m-d'),
            'older_adults' => 2,
            'minor_adults' => 1,
            'children' => 1,
            'medications' => 'Aspirina, Ibuprofeno',
            'health_history' => 'Hipertensión, Diabetes',
            'reason' => 'Dolor de cabeza persistente',
            'anamnesis' => 'Paciente con dolor de cabeza durante 5 días, sin mejoría con analgésicos.',
            'physical_examination' => 'Presión arterial 140/90, pulso 75, no fiebre.',
            'diagnosis' => 'Cefalea tensional',
            'indications' => 'Reposo, Paracetamol 500 mg cada 8 horas, hidratación.',
            'others' => 'Se recomienda seguimiento en 3 días si no hay mejoría.',
            'name_provider' => 'Dr. Carlos Rodríguez',
            'rut_provider' => '9.876.543-2',
            'registration_number' => '123456',
            'signature' => 'Dr. Carlos Rodríguez'
        ];

        $pdf = Pdf::loadView('pdf.clinicalRecord', ['data' => $data]);

        return $pdf->download('clinical_record.pdf');
    }
}
