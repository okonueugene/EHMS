<?php

namespace App\Models;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Triage extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'body_temperature',
        'pulse_rate',
        'respiratory_rate',
        'blood_pressure',
        'height',
        'weight',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
