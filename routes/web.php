<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\InteragencyController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    Route::prefix('search')->group(function () {
        Route::controller(SearchController::class)->group(function () {
            Route::get('/', 'index');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('reports')->group(function () {
        Route::controller(ReportsController::class)->group(function () {
            Route::get('/agents', 'agents');
            Route::get('/agents/print', 'print_agents');
            Route::get('/authentications', 'authentications');
            Route::get('/authentications/print', 'print_authentications');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('interagency')->group(function () {
        Route::controller(InteragencyController::class)->group(function () {
            Route::get('/hpg', 'hpg');
        });
    });
});

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
            Route::get('/claim/{id}', 'claim');
        });
    });
});

Route::middleware('auth')->group(function () {
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
});

Route::middleware('auth')->group(function () {
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
    if(Auth::user()->role == 'admin') {
        $sql =
        "SELECT
            DISTINCT(`u`.`branch`) AS `branch`,
            COUNT(`csn`.`series_number`) AS `count`
            FROM `coc_series_numbers` `csn`
        INNER JOIN `users` `u` ON `csn`.`agent_id`=`u`.`id`
            WHERE `csn`.`status`='used'
        GROUP BY `u`.`branch`";
    } else {
        $sql =
        "SELECT
            DISTINCT(`u`.`branch`) AS `branch`,
            COUNT(`auth`.`id`) AS `count`
            FROM `authentications` `auth`
        INNER JOIN `users` `u` ON `auth`.`agent_id`=`u`.`id`
            WHERE `auth`.`agent_id` IN
            (SELECT `subagent_id` FROM `subagents` WHERE `agent_id`=".Auth::user()->id.")
        GROUP BY `u`.`branch`";
    }

    $uploads = DB::select($sql);

    return view('dashboard', [
        'uploads' => $uploads,
    ]);
})->middleware('auth');

Route::get('/logs', function () {
    return view('logs');
})->middleware('auth');
