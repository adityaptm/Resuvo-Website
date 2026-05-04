<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CvDataController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/builder', [CvDataController::class, 'create'])->name('cv.create');
Route::post('/builder', [CvDataController::class, 'store'])->name('cv.store');
Route::get('/cv/{slug}', [CvDataController::class, 'show'])->name('cv.show');

Route::get('/pay/{slug}', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/pay/success/{slug}', [PaymentController::class, 'simulateSuccess'])->name('payment.success');

// Placeholder routes to prevent 404
Route::get('/about', function() { return view('welcome'); });
Route::get('/pricing', function() { return view('welcome'); });
Route::get('/templates', function() { return view('welcome'); });
Route::get('/contact', function() { return view('welcome'); });
