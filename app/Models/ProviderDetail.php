<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderDetail extends Model
{
    use HasFactory;

    protected $table = 'providers_details';

    protected $fillable = [
        'user_id',
        'registration_number',
        'license_number',
        'id_card',
        'certificate_criminal_record',
        'signature',
    ];

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
