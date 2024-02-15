<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MedicalDiagnosisController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PointManagementController;
use App\Http\Middleware\CookieToHeaderToken;

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

Route::post('/auth/signup', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/auth/get-all-users', [AuthController::class, 'getAllusers'])->middleware('auth:sanctum');
Route::get('/auth/getUsrById/{id}', [AuthController::class, 'getUsrById'])->middleware('auth:sanctum');
Route::get('/auth/getUsrByname/{name}', [AuthController::class, 'getUsrByName'])->middleware('auth:sanctum');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/activate', [AuthController::class, 'activateUser']);
    Route::post('/auth/deactivate', [AuthController::class, 'deactivateUser']);
    Route::get('/point-management/users-with-points', [PointManagementController::class, 'getAllusersWithPoints'])->middleware(['can:manage users']);
    Route::post('/payments/granting-trial-period', [PaymentsController::class, 'grantingTrialPeriod'])->middleware(['can:manage users']);
    Route::post('/payments/add-points-to-user', [PaymentsController::class, 'addPointsToUser'])->middleware(['can:manage users']);
    Route::get('/main-page/userProfile', [AuthController::class, 'getUserProfile']);
    Route::post('/medical-diagnosis/get-diagnosis',[MedicalDiagnosisController::class,'getBasicAIDiagnosis']);

});



