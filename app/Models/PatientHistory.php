<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'uuid',
        'user_id',
        'symptoms',
        'diagnosis',
        'prescription',
        'lab_test_results',
    ];
}
