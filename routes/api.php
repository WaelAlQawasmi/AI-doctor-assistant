<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MedicalDiagnosisController;
use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\PointManagementController;
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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/auth/get-all-users', [AuthController::class, 'getAllusers'])->middleware('can:manage users');
    Route::get('/auth/getUsrById/{id}', [AuthController::class, 'getUsrById'])->middleware('can:manage users');
    Route::get('/auth/getUsrByname/{name}', [AuthController::class, 'getUsrByName'])->middleware('can:manage users');
    Route::post('/auth/activate', [AuthController::class, 'activateUser']);
    Route::post('/auth/deactivate', [AuthController::class, 'deactivateUser']);
    Route::get('/point-management/users-with-points', [PointManagementController::class, 'getAllusersWithPoints'])->middleware(['can:manage users']);
    Route::post('/payments/granting-trial-period', [PaymentsController::class, 'grantingTrialPeriod'])->middleware(['can:manage users']);
    Route::post('/payments/add-points-to-user', [PaymentsController::class, 'addPointsToUser'])->middleware(['can:manage users']);
    Route::get('/main-page/userProfile', [AuthController::class, 'getUserProfile']);
    Route::post('/medical-diagnosis',[MedicalDiagnosisController::class,'getBasicAIDiagnosis'])->middleware(['CookieToHeaderToken',CookieToHeaderToken::class]);

});



