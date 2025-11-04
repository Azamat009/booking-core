<?php

use App\Http\Controllers\Api\GuideController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('guides')->group(function () {
    Route::get('/', [GuideController::class, 'index']);
});
Route::prefix('hunting_bookings')->group(function () {
    Route::post('/', [\App\Http\Controllers\Api\HuntingBookingController::class, 'store'])->name('hunting_bookings.store');
});
