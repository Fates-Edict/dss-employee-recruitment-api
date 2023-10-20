<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\JobVacanciesController;
use App\Http\Controllers\AlternativesController;
use App\Http\Controllers\CriteriaController;

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

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/me', [UsersController::class, 'me']);

    Route::prefix('users')->controller(UsersController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{id}', 'findById');
        Route::post('/', 'store');
        Route::put('/{id}', 'store');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('roles')->controller(RolesController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{id}', 'findById');
        Route::post('/', 'store');
        Route::put('/{id}', 'store');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('modules')->controller(ModulesController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{id}', 'findById');
        Route::post('/', 'store');
        Route::put('/{id}', 'store');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('job-vacancies')->controller(JobVacanciesController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{id}', 'findById');
        Route::post('/', 'store');
        Route::put('/{id}', 'store');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('alternatives')->controller(AlternativesController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{id}', 'findById');
        Route::post('/', 'store');
        Route::put('/{id}', 'store');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('criteria')->controller(CriteriaController::class)->group(function() {
        Route::get('/', 'index');
        Route::get('/{id}', 'findById');
        Route::post('/', 'store');
        Route::put('/{id}', 'store');
        Route::delete('/{id}', 'destroy');
    });
});