<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PatientsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//login
Route::post('/v1/login', [UserController::class, 'login']);



Route::group([
    'prefix' => 'v1',
    'middleware' => ['auth:api','ensure.json.header']
], function () {

    //user routes
    Route::get("getUsers", [UserController::class, 'getUsers']);
    Route::post("addUsers", [UserController::class, 'addUsers']);
    Route::put("updateUsers/{id}", [UserController::class, 'updateUsers']);
    Route::delete("deleteUsers/{id}", [UserController::class, 'deleteUsers']);


    //patient routes
    Route::post("addPatients", [PatientsController::class, 'addPatients']);
    Route::get("getPatients", [PatientsController::class, 'getPatients']);
});
