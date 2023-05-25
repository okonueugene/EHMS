<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Nurse\NursesDashboard;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Doctor\DoctorsDashboard;
use App\Http\Livewire\Reception\ReceptionistDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route("login"));
});

Route::get('/login', LoginController::class)->name('login');

//admin routes
Route::group(['middleware'=> 'auth'], function () {
    Route::group(
        [
        'prefix'=>'admin',
        'middleware'=>'admin',
        'as'=>'admin.'
    ],
        function () {
            Route::get('dashboard', AdminDashboard::class)->name('dashboard');

        }
    );
});


//doctor routes

Route::group(['middleware'=> 'auth'], function () {
    Route::group(
        [
        'prefix'=>'doctor',
        'middleware'=>'doctor',
        'as'=>'doctor.'
    ],
        function () {
            Route::get('dashboard', DoctorsDashboard::class)->name('dashboard');

        }
    );
});

// nurse routes

Route::group(['middleware'=> 'auth'], function () {
    Route::group(
        [
        'prefix'=>'nurse',
        'middleware'=>'nurse',
        'as'=>'nurse.'
    ],
        function () {
            Route::get('dashboard', NursesDashboard::class)->name('nurses-dashboard');

        }
    );
});

// receptionist routes

Route::group(['middleware'=> 'auth'], function () {
    Route::group(
        [
        'prefix'=>'receptionist',
        'middleware'=>'receptionist',
        'as'=>'receptionist.'
    ],
        function () {
            Route::get('dashboard', ReceptionistDashboard::class)->name('dashboard');

        }
    );
});
