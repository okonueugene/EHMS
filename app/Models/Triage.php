<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
