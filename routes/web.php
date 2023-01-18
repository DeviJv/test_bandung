<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TiketController;
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
    return view('welcome');
});

Auth::routes();

Route::get('booking_check/{id}', [CheckInController::class, 'show'])->name('booking_check');
Route::get('get_tiket_id/{id}', [CheckInController::class, 'get_harga']);
Route::get('booking_customer', [CheckInController::class, 'booking_form'])->name('booking_customer');
Route::resource('bookings', BookingController::class);
Route::get('bookings_r/{id}', [BookingController::class, 'restore'])->name('booking_restore');

Route::group(['middleware' => 'auth'], function () {



    Route::resource('customers', CustomerController::class)->middleware('auth');
    Route::get('customers_r/{id}', [CustomerController::class, 'restore'])->name('customer_restore')->middleware('auth');

    Route::resource('tikets', TiketController::class)->middleware('auth');
    Route::get('tikets_r/{id}', [TiketController::class, 'restore'])->name('tiket_restore')->middleware('auth');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');