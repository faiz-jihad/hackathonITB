<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sinilah kita mendaftarkan endpoint untuk AI MangsaPadi.
| Semua rute di file ini secara otomatis akan memiliki awalan "/api"
| di URL-nya (contoh: localhost:8000/api/v1/diagnosa).
|
*/

// Kelompokkan dalam versi 1 (Best practice untuk API)
Route::prefix('v1')->group(function () {

    // Endpoint utama untuk menerima foto dari Frontend HTML5
    Route::post('/diagnosa', [DiagnosaController::class, 'proses']);

    // Endpoint opsional untuk mengecek apakah API Laravel menyala (Health Check)
    Route::get('/ping', function () {
        return response()->json([
            'status' => 'success',
            'message' => 'API MangsaPadi (SEED) aktif dan siap menerima foto!'
        ]);
    });

});
