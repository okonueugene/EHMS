<?php

namespace App\Models;

use App\Models\Triage;
use App\Models\PatientHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_name',
        'age',
        'address',
        'gender',
        'phone_number',
    ];


    public function history()
    {
        return $this->hasMany(PatientHistory::class);
    }

    public function triage()
    {
        return $this->hasMany(Triage::class);
    }
}
