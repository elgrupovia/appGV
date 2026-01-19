<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    Route::apiResource('events', EventController::class);

    Route::post('/events/{event}/register', [App\Http\Controllers\Api\RegistrationController::class, 'store']);
    Route::get('/my-registrations', [App\Http\Controllers\Api\RegistrationController::class, 'index']);
    Route::delete('/my-registrations/{registration}', [App\Http\Controllers\Api\RegistrationController::class, 'destroy']);
});
