<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\ZohoWebhookController;

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

// Endpoint para recibir datos desde Zoho CRM (POST)
Route::post('/zoho-webhook', [ZohoWebhookController::class, 'handleWebhook']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'me']);

    // Events
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{event}', [EventController::class, 'show']);
    Route::post('/events', [EventController::class, 'store'])->middleware(\App\Http\Middleware\RoleMiddleware::class . ':admin');
    Route::put('/events/{event}', [EventController::class, 'update'])->middleware(\App\Http\Middleware\RoleMiddleware::class . ':admin');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->middleware(\App\Http\Middleware\RoleMiddleware::class . ':admin');


    Route::post('/events/{event}/register', [App\Http\Controllers\Api\RegistrationController::class, 'store'])->middleware(\App\Http\Middleware\RoleMiddleware::class . ':attendee');
    Route::get('/my-registrations', [App\Http\Controllers\Api\RegistrationController::class, 'index'])->middleware(\App\Http\Middleware\RoleMiddleware::class . ':attendee');
    Route::delete('/my-registrations/{registration}', [App\Http\Controllers\Api\RegistrationController::class, 'destroy'])->middleware(\App\Http\Middleware\RoleMiddleware::class . ':attendee');
});
