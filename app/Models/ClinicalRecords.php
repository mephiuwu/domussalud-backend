<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicalRecords extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'rut',
        'age',
        'address',
        'phone',
        'marital_status',
        'birthdate',
        'profession',
        'occupation',
        'admission_date',
        'medical_service',
        'household_members',
        'consultation_reason',
        'medical_history',
        'medications',
        'allergies',
        'anamnesis',
        'physical_exam',
        'instructions',
        'provider_id',
        'patient_id',
        'created_by',
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

    // Definir las fechas que deben ser tratadas como Carbon instances
    protected $dates = ['birthdate', 'admission_date', 'deleted_at'];

    // Método para obtener el nombre completo del paciente (opcional)
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
