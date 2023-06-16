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
    Route::post('reservation-table', [ReservationController::class, 'reservationTable'])->name('reservation-table');
    Route::get('reservation-edit/{id}', [ReservationController::class, 'reservationEdit'])->name('reservation-edit');
    Route::post('reservation-get', [ReservationController::class, 'reservationGet'])->name('reservation-get');

    Route::get('client-manage', [ClientController::class, 'index'])->name('client-manage');
    Route::post('client-table', [ClientController::class, 'clientTable'])->name('client-table');
    Route::get('client-edit/{id}', [ClientController::class, 'clientEdit'])->name('client-edit');
    Route::post('client-export-csv', [ClientController::class, 'clientExportCSV'])->name('client-export-csv');

    Route::get('noti-manage', [NotificationController::class, 'index'])->name('noti-manage');
    Route::post('noti-table', [NotificationController::class, 'notiTable'])->name('noti-table');
    Route::post('noti-read', [NotificationController::class, 'notiRead'])->name('noti-read');

    Route::get('shop-manage', [ShopController::class, 'index'])->name('shop-manage');
    Route::post('shop-table', [ShopController::class, 'shopTable'])->name('shop-table');
    Route::post('shop-save', [ShopController::class, 'shopSave'])->name('shop-save');
    Route::post('shop-delete', [ShopController::class, 'shopDelete'])->name('shop-delete');
    Route::get('shop-create-code', [ShopController::class, 'shopCreateCode'])->name('shop-create-code');

    Route::get('menu-manage', [MenuController::class, 'index'])->name('menu-manage');
    Route::post('menu-table', [MenuController::class, 'menuTable'])->name('menu-table');
    Route::get('menu-create-code', [MenuController::class, 'menuCreateCode'])->name('menu-create-code');
    Route::post('menu-change-display', [MenuController::class, 'menuChangeDisplay'])->name('menu-change-display');
    Route::post('menu-save', [MenuController::class, 'menuSave'])->name('menu-save');
    Route::post('menu-delete', [MenuController::class, 'menuDelete'])->name('menu-delete');

    Route::get('my-page', [MyController::class, 'index'])->name('my-page');
    Route::post('change-password', [MyController::class, 'changePassword'])->name('change-password');
});

require __DIR__.'/auth.php';
