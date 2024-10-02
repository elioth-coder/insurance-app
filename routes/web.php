<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\InteragencyController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SerialNumberController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::prefix('search')->group(function () {
        Route::controller(SearchController::class)->group(function () {
            Route::get('/', 'index');
        });
    });

    Route::prefix('reports')->group(function () {
        Route::controller(ReportsController::class)->group(function () {
            Route::get('/agents', 'agents');
            Route::get('/agents/print', 'print_agents');
            Route::get('/authentication_fees', 'authentication_fees');
            Route::get('/authentication_fees/print', 'print_authentication_fees');
            Route::get('/authentication_taxes', 'authentication_taxes');
            Route::get('/authentication_taxes/print', 'print_authentication_taxes');
        });
    });

    Route::prefix('interagency')->group(function () {
        Route::controller(InteragencyController::class)->group(function () {
            Route::get('/hpg', 'hpg');
        });
    });

    Route::prefix('authentication')->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::get('/verify', 'verify');
            Route::get('/claim', 'claim');
            Route::get('/void', 'void');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
            Route::get('/claim/{id}', 'claim');
        });
    });

    Route::prefix('claims')->group(function () {
        Route::controller(ClaimController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/process/{serial}', 'accidents');
            Route::get('/process/{serial}/{accident_id}', 'accident');
            Route::get('/process/{serial}/{accident_id}/{injured_id}', 'injured');
            Route::post('/accidents', 'store_accident');
            Route::post('/accidents/injured', 'store_injured');
            Route::patch('/accidents/injured/{id}', 'approve');
            Route::patch('/accidents/injured/deny/{id}', 'deny');

            Route::get('/verify', 'verify');
        });
    });

    Route::prefix('series')->group(function () {
        Route::controller(SeriesController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::get('/owned', 'owned');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('agents')->group(function () {
        Route::controller(AgentController::class)->group(function () {
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

    Route::prefix('serial_numbers')->group(function () {
        Route::controller(SerialNumberController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/print', 'print');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('settings/domains')->group(function () {
        Route::controller(DomainController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('settings/vehicle_types')->group(function () {
        Route::controller(VehicleTypeController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('settings/announcements')->group(function () {
        Route::controller(AnnouncementController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('settings')->group(function () {
        Route::controller(SettingController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/create', 'create');
            Route::post('/', 'store');
            Route::get('/{id}', 'show');
            Route::get('/{id}/edit', 'edit');
            Route::patch('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

    Route::prefix('branches')->group(function () {
        Route::controller(BranchController::class)->group(function () {
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::post('/api/authentication/vehicle', [AuthenticationController::class, 'vehicle']);
Route::post('/api/authentication/store', [AuthenticationController::class, 'authenticate']);
Route::post('/api/authentication/check_serial', [AuthenticationController::class, 'check_serial']);
Route::post('/api/authentication/verify_serial', [AuthenticationController::class, 'verify_serial']);
Route::post('/api/authentication/void_serial', [AuthenticationController::class, 'void_serial']);
Route::get('/authentication/{id}/view', [AuthenticationController::class, 'view']);
Route::get('/authentication/{id}/print', [AuthenticationController::class, 'print']);

Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard', function () {
    if(Auth::user()->role == 'admin') {
        $sql =
        "SELECT
            DISTINCT(`u`.`branch_id`) AS `branch_id`,
            (SELECT `name` FROM `branches` WHERE `id`=`branch_id`) AS `branch_name`,
            COUNT(`au`.`coc_number`) AS `count`
            FROM `authentications` `au`
        INNER JOIN `users` `u` ON `au`.`agent_id`=`u`.`id`
            GROUP BY `u`.`branch_id`";
    } else {
        $sql =
        "SELECT
            DISTINCT(`u`.`branch_id`) AS `branch_id`,
            (SELECT `name` FROM `branches` WHERE `id`=`branch_id`) AS `branch_name`,
            COUNT(`au`.`coc_number`) AS `count`
            FROM `authentications` `au`
        INNER JOIN `users` `u` ON `au`.`agent_id`=`u`.`id`
            WHERE `au`.`agent_id` IN
            (SELECT `subagent_id` FROM `subagents` WHERE `agent_id`=".Auth::user()->id.")
        GROUP BY `u`.`branch_id`";
    }

    $authentications = DB::select($sql);
    $announcements = DB::table('announcements')->orderBy('created_at', 'DESC')->get();

    return view('dashboard', [
        'authentications' => $authentications,
        'announcements' => $announcements,
    ]);
})->middleware('auth');

Route::get('/logs', function () {
    return view('logs');
})->middleware('auth');
