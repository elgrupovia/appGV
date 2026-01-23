<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebEventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ZohoWebhookController;

Route::get('/', function () {
    return redirect('/events');
});

Route::get('/events', [WebEventController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/events/create', [WebEventController::class, 'create'])->name('events.create');
    Route::post('/events', [WebEventController::class, 'store'])->name('events.store');
});

Route::get('/events/{event}', [WebEventController::class, 'show']);

// Endpoint to receive event data from Zoho CRM (POST)
Route::post('/zoho-webhook', [ZohoWebhookController::class, 'handle']);


// Registration Routes
Route::get('/register', [AuthController::class, 'createRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegistration']);

// Login Routes
Route::get('/login', [AuthController::class, 'createLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// User Routes (protegidas)
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Registration Routes (protegidas)
    Route::get('/registrations', [RegistrationController::class, 'index']);
    Route::get('/registrations/create', [RegistrationController::class, 'create']);
    Route::post('/registrations', [RegistrationController::class, 'store']);
    Route::get('/registrations/{registration}', [RegistrationController::class, 'show']);
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy']);
});
