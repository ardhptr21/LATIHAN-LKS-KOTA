<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $movies = \App\Models\Movie::limit(10)->get();
    return view('pages.home', compact('movies'));
});

Route::prefix('/schedules')->middleware('auth')->controller(ScheduleController::class)->group(function () {
    Route::get('/admin', 'admin')->name('schedules.admin')->middleware('role:admin');
    Route::put('/update/{schedule}', 'update')->name('schedules.update');
    Route::delete('/{schedule}', 'destroy')->name('schedules.destroy');

    Route::post('/', 'store')->name('schedules.store');
    Route::get('/', 'index')->name('schedules.index');
});

Route::prefix('/branches')->middleware(['auth', 'role:admin'])->controller(BranchController::class)->group(function () {
    Route::put('/update/{branch}', 'update')->name('branches.update');

    Route::delete('/{branch}', 'destroy')->name('branches.destroy');

    Route::get('/', 'index')->name('branches.index');
    Route::post('/', 'store')->name('branches.store');
});

Route::prefix('/studios')->middleware(['auth', 'role:admin'])->controller(StudioController::class)->group(function () {
    Route::put('/update/{studio}', 'update')->name('studios.update');

    Route::delete('/{studio}', 'destroy')->name('studios.destroy');

    Route::get('/', 'index')->name('studios.index');
    Route::post('/', 'store')->name('studios.store');
});

Route::prefix('/movies')->middleware(['auth', 'role:admin'])->controller(MovieController::class)->group(function () {
    Route::put('/update/{movie}', 'update')->name('movies.update');

    Route::delete('/{movie}', 'destroy')->name('movies.destroy');

    Route::get('/', 'index')->name('movies.index');
    Route::post('/', 'store')->name('movies.store');
});


Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'registerView')->name('auth.register')->middleware('guest');
    Route::post('/register', 'register');
    Route::get('/login', 'loginView')->name('auth.login')->middleware('guest');
    Route::post('/login', 'login');

    Route::post('/logout', 'logout')->name('auth.logout');
});
