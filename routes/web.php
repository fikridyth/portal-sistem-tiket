<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::name('auth.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login-submit');
    Route::post('/register-submit', [AuthController::class, 'registerSubmit'])->name('register-submit');
});

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::middleware('admin.transaction')->resource('/transaction', TransactionController::class, ['parameters' => ['transaction' => 'id']]);
    Route::middleware('admin.transaction')->get('/transaction-orders', [TransactionController::class, 'exportTransactions'])->name('transaction.export-orders');

    Route::middleware('admin.ticket')->prefix('master')->name('master.')->group(function () {
        Route::resource('/event', EventController::class, ['parameters' => ['event' => 'id']]);
        Route::resource('/ticket', TicketController::class, ['parameters' => ['ticket' => 'id']]);
    });
});
