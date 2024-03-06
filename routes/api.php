<?php

use App\Http\Controllers\Agents\AgentController;
use App\Http\Controllers\Appointments\AppointmentController;
use App\Http\Controllers\Epidemiologics\EpidemiologicsController;
use App\Http\Controllers\Illnesses\IllnessController;
use App\Http\Controllers\Patients\PatientController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Services\ServicesController;
use App\Http\Controllers\Templates\TemplateController;
use App\Http\Controllers\Users\UserController;
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
    Route::get('/search/name',[PatientController::class,'searchPatient']);
    Route::post('/attach',[PatientController::class,'attach']);
});

Route::group(['prefix' => 'appointments'], function (){
    Route::get('/',[AppointmentController::class,'index']);
    Route::post('/',[AppointmentController::class,'store']);
    Route::put('/{appointment}',[AppointmentController::class,'update']);
    Route::delete('/{appointment}',[AppointmentController::class,'destroy']);
});

Route::group(['prefix' => 'illnesses'], function (){
    Route::apiResource('illnesses',IllnessController::class);
    Route::get('/illness/all',[IllnessController::class,'getAll']);
});

Route::group(['prefix' => 'epidemiologics'], function (){
    Route::apiResource('epidemiologics',EpidemiologicsController::class);
    Route::get('/epidemiologic/all',[EpidemiologicsController::class,'getAll']);
});

Route::group(['prefix' => 'services'], function (){
    Route::apiResource('services',ServicesController::class);
    Route::get('/service/all',[ServicesController::class,'getAll']);
});
Route::apiResource('roles',RoleController::class);
Route::get('role/all',[RoleController::class,'getAll']);

Route::apiResource('users',UserController::class);
Route::post('login',[UserController::class,'login']);
Route::get('user/doctors',[UserController::class,'getDoctorRoleAllUser']);
Route::get('payments',[PaymentController::class,'index']);
Route::get('payment/all',[PaymentController::class,'getAll']);
Route::post('payments',[PaymentController::class,'store']);
Route::post('payment/{user_id}',[PaymentController::class,'getUserIDForPayment']);
Route::apiResource('templates',TemplateController::class);
Route::get('template/user/{user_id}',[TemplateController::class,'showUserTemplate']);
