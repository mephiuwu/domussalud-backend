<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicalRecords extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'rut',
        'age',
        'phone',
        'responsible_family_member',
        'date',
        'number',
        'older_adults',
        'minor_adults',
        'children',
        'medications',
        'health_history',
        'reason',
        'anamnesis',
        'physical_examination',
        'diagnosis',
        'indications',
        'others',
        'name_provider',
        'rut_provider',
        'registration_number',
        'signature',
    ];

    // Relación con el modelo Provider (Prestador)
    public function provider()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo Patient (Paciente)
    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el modelo User (Quien creó la ficha)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $dates = ['birthdate', 'admission_date', 'deleted_at'];
}
