<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TriagesController extends Controller
{
    //add triage

    public function addTriage(Request $request)
    {
        //validate input

        $rules= [
            'patient_id' => 'required',
        'body_temperature' => 'required',
        'pulse_rate' => 'required',
        'respiratory_rate ' => 'required',
        'blood_pressure' => 'required',
        'height' => 'required',
        'weight' => 'required',
        ];

        $this->validate($request, $rules);

        //create triage

        $triage = Triage::create([
            'patient_id' => $request->patient_id,
            'body_temperature' => $request->body_temperature,
            'pulse_rate' => $request->pulse_rate,
            'respiratory_rate' => $request->respiratory_rate,
            'blood_pressure' => $request->blood_pressure,
            'height' => $request->height,
            'weight' => $request->weight,
        ]);

        if($triage) {
            return response()->json([
                'status' => 'success',
                'message' => 'Triage created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Triage creation failed'
            ], 400);
        }
    }

    //get triage by id

    public function getTriage(Request $request)
    {
        $triage = Triage::find($request->id);

        if($triage) {
            return response()->json([
                'status' => 'success',
                'message' => 'Triage fetched successfully',
                'data' => $triage
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Triage fetch failed check id'
            ], 400);
        }
    }

    //get all triages by patient id

    public function getTriagesByPatientId(Request $request)
    {
        $triages = Triage::where('patient_id', $request->patient_id)->get();

        if($triages) {
            return response()->json([
                'status' => 'success',
                'message' => 'Triages fetched successfully',
                'data' => $triages
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Triages fetch failed check id'
            ], 400);
        }
    }

    //update triage

    public function updateTriage(Request $request)
    {
        //validate input

        $rules= [
            'patient_id' => 'required',
        'body_temperature' => 'required',
        'pulse_rate' => 'required',
        'respiratory_rate ' => 'required',
        'blood_pressure' => 'required',
        'height' => 'required',
        'weight' => 'required',
        ];

        $this->validate($request, $rules);

        //update triage

        $triage = Triage::findOrfail($request->id)->update(
            [
                'patient_id' => $request->patient_id,
                'body_temperature' => $request->body_temperature,
                'pulse_rate' => $request->pulse_rate,
                'respiratory_rate' => $request->respiratory_rate,
                'blood_pressure' => $request->blood_pressure,
                'height' => $request->height,
                'weight' => $request->weight,
            ]
        );

        if($triage) {
            return response()->json([
                'status' => 'success',
                'message' => 'Triage updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Triage update failed check id'
            ], 400);
        }
    }



}
