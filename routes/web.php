<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
Route::prefix('clients')->group(function () {
Route::controller(ClientController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::get('/{id}/edit', 'edit');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
});
});

Route::middleware('auth')->group(function () {
Route::prefix('clients/{id}/vehicles')->group(function () {
Route::controller(VehicleController::class)->group(function () {
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::delete('/{vehicle_id}', 'destroy');
});
});
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');