<?php

use App\Http\Controllers\Agents\AgentController;
use App\Http\Controllers\Appointments\AppointmentController;
use App\Http\Controllers\Patients\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'agents'], function (){
   Route::apiResource('/agents',AgentController::class);
   Route::get('/all',[AgentController::class,'getAll']);
});

Route::group(['prefix' => 'patients'], function (){
    Route::apiResource('/patients',PatientController::class);
    Route::get('/all',[PatientController::class,'getAll']);
});

Route::group(['prefix' => 'appointments'], function (){
    Route::get('/',[AppointmentController::class,'index']);
    Route::post('/',[AppointmentController::class,'store']);
    Route::put('/{appointment}',[AppointmentController::class,'update']);
});
