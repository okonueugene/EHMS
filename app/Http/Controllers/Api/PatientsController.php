<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientsController extends Controller
{
    public function addPatients(Request $request)
    {

        //validate input
        $rules = [
            'patient_name' => 'required',
            'age' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|min:10|max:12',
        ];

        $this->validate($request, $rules);

        //create patient

        $patient = Patient::create([
            'patient_name' => $request->patient_name,
            'age' => $request->age,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,

        ]);

        if($patient) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient creation failed'
            ], 400);
        }

    }

    public function getPatients()
    {
        $patients = Patient::all();

        if($patients) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patients fetched successfully',
                'data' => $patients
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patients fetch failed'
            ], 400);
        }
    }

    public function updatePatient(Request $request)
    {
        //validate input

        $rules = [
            'patient_name' => 'required',
            'age' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|min:10|max:12',
        ];

        $this->validate($request, $rules);

        //update patient
        $patient = Patient::findOrFail($request->id)->update([
            'patient_name' => $request->patient_name,
            'age' => $request->age,
            'address' => $request->address,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
        ]);

        if($patient) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient update failed'
            ], 400);
        }


    }

    public function deletePatient(Request $request)
    {
        $patient = Patient::findOrFail($request->id)->delete();

        if($patient) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient deletion failed'
            ], 400);
        }
    }
}
