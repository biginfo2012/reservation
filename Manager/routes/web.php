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

Route::get('/', function () {
    return view('auth.login');
});
Route::group(['middleware' => 'auth'], function (){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('reservation-list', [ReservationController::class, 'index'])->name('reservation-list');

    Route::get('client-manage', [ClientController::class, 'index'])->name('client-manage');

    Route::get('noti-manage', [NotificationController::class, 'index'])->name('noti-manage');

    Route::get('shop-manage', [ShopController::class, 'index'])->name('shop-manage');

    Route::get('menu-manage', [MenuController::class, 'index'])->name('menu-manage');

    Route::get('my-page', [MyController::class, 'index'])->name('my-page');
});

require __DIR__.'/auth.php';
