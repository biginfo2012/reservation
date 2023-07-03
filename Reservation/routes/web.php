<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/{id}', [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation-add', [ReservationController::class, 'reservationAdd'])->name('reservation-add');
Route::get('/cancel/{code}', [ReservationController::class, 'reservationCancel'])->name('reservation-cancel');
Route::post('/cancel-reservation', [ReservationController::class, 'reservationCancelPost'])->name('cancel-reservation');
Route::post('/cancel-reservation-mail', [ReservationController::class, 'reservationCancelMail'])->name('cancel-reservation-mail');

//require __DIR__.'/auth.php';
