<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientHistoryController extends Controller
{
    //add patient history
    public function addPatientHistory()
    {
        //validate input

        $rules = [
            'patient_id' => 'required',
            'user_id' => 'required',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'prescription' => 'required',
            'lab_test_results' => 'required',
        ];

        $this->validate($request, $rules);

        function generateUniqueHealthRecordIdentifier()
        {
            // Generate a random string of 11 characters.
            $randomString = Str::random(11);

            // Return the random string as the unique identifier.
            return $randomString;
        }

        //create patient history

        $patientHistory = PatientHistory::create([
            'patient_id' => $request->patient_id,
            'uuid' => generateUniqueHealthRecordIdentifier(),
            'user_id' => $request->user_id,
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'prescription' => $request->prescription,
            'lab_test_results' => $request->lab_test_results,
        ]);

        if($patientHistory) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient history created successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history creation failed'
            ], 400);
        }
    }

    //get patient history by id

    public function getPatientHistoryById(Request $request)
    {
        $patientHistory = PatientHistory::find($request->id);

        if($patientHistory) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient history fetched successfully',
                'data' => $patientHistory
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history fetch failed'
            ], 400);
        }
    }

    //get all patient history

    public function getPatientHistory()
    {
        $patientHistory = PatientHistory::all();

        if($patientHistory) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient history fetched successfully',
                'data' => $patientHistory
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history fetch failed'
            ], 400);
        }
    }

    //update patient history

    public function updatePatientHistory(Request $request)
    {
        //validate input

        $rules = [
            'patient_id' => 'required',
            'user_id' => 'required',
            'symptoms' => 'required',
            'diagnosis' => 'required',
            'prescription' => 'required',
            'lab_test_results' => 'required',
        ];

        $this->validate($request, $rules);

        //update patient history

        $patientHistory = PatientHistory::find($request->id);

        if($patientHistory) {
            $patientHistory->update([
                'patient_id' => $request->patient_id,
                'user_id' => $request->user_id,
                'symptoms' => $request->symptoms,
                'diagnosis' => $request->diagnosis,
                'prescription' => $request->prescription,
                'lab_test_results' => $request->lab_test_results,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Patient history updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history update failed'
            ], 400);
        }
    }

    //delete patient history

    public function deletePatientHistory(Request $request)
    {
        $patientHistory = PatientHistory::find($request->id);

        if($patientHistory) {
            $patientHistory->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Patient history deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history delete failed'
            ], 400);
        }
    }

    //get patient history by patient id

    public function getPatientHistoryByPatientId(Request $request)
    {
        $patientHistory = PatientHistory::where('patient_id', $request->patient_id)->get();

        if($patientHistory) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient history fetched successfully',
                'data' => $patientHistory
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history fetch failed'
            ], 400);
        }
    }

    //get patient history by patient name through relationship history

    public function getPatientHistoryByPatientName(Request $request)
    {
        $patientHistory = PatientHistory::whereHas('patient', function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->name.'%');
        })->get();

        if($patientHistory) {
            return response()->json([
                'status' => 'success',
                'message' => 'Patient history fetched successfully',
                'data' => $patientHistory
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Patient history fetch failed'
            ], 400);
        }
    }




}
