<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\CommunityController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/edukasi', function () { return view('pages.edukasi'); })->name('edukasi');
Route::post('/predict', [DiagnosaController::class, 'predict'])->name('predict');

Route::get('/komunitas', [CommunityController::class, 'index'])->name('komunitas.index');
Route::post('/komunitas/message', [CommunityController::class, 'storeMessage'])->name('komunitas.message');

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\KearifanLokalController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/kearifan-lokal', [KearifanLokalController::class, 'index'])->name('kearifan-lokal.index');
        Route::get('/kearifan-lokal/create', [KearifanLokalController::class, 'create'])->name('kearifan-lokal.create');
        Route::post('/kearifan-lokal', [KearifanLokalController::class, 'store'])->name('kearifan-lokal.store');
        Route::get('/kearifan-lokal/{kearifanLokal}/edit', [KearifanLokalController::class, 'edit'])->name('kearifan-lokal.edit');
        Route::put('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'update'])->name('kearifan-lokal.update');
        Route::delete('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'destroy'])->name('kearifan-lokal.destroy');

        // Admin User Management routes
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
    });
});
