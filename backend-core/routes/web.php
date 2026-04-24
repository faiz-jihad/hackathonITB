<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiagnosaController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/predict', [DiagnosaController::class, 'predict'])->name('predict');
