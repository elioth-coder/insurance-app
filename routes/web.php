<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CocSeriesController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SubagentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\AuthenticationController;
use App\Models\Authentication;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
Route::prefix('authentication')->group(function () {
Route::controller(AuthenticationController::class)->group(function () {
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
Route::prefix('coc_series')->group(function () {
Route::controller(CocSeriesController::class)->group(function () {
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
Route::prefix('subagents')->group(function () {
Route::controller(SubagentController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::get('/{id}/edit', 'edit');
    Route::patch('/{id}', 'update');
    Route::delete('/{id}', 'destroy');

    Route::patch('/{id}/lock', 'lock');
    Route::patch('/{id}/unlock', 'unlock');
});
});
});

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
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{vehicle_id}', 'show');
    Route::get('/{vehicle_id}/edit', 'edit');
    Route::patch('/{vehicle_id}', 'update');
    Route::delete('/{vehicle_id}', 'destroy');
});
});
});

Route::middleware('auth')->group(function () {
Route::prefix('clients/{id}/vehicles/{vehicle_id}/insurances')->group(function () {
Route::controller(InsuranceController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{insurance_id}', 'show');
    Route::get('/{insurance_id}/edit', 'edit');
    Route::patch('/{insurance_id}', 'update');
    Route::delete('/{insurance_id}', 'destroy');
});
});
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('/authentication/{id}/view', [AuthenticationController::class, 'view']);
Route::get('/authentication/{id}/print', [AuthenticationController::class, 'print']);

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

