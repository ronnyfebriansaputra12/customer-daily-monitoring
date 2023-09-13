<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use GuzzleHttp\PrepareBodyMiddleware;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/', 'App\Http\Controllers\AuthController@login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/forgot_password', [AuthController::class, 'forgotPassword']);
Route::post('/forgot_password_proses', [AuthController::class, 'forgotPasswordProses']);
Route::get('/reset_password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset_password_proses', [AuthController::class, 'resetPasswordProses']);
Route::post('/login', 'App\Http\Controllers\AuthController@loginProses');
Route::get('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/register', 'App\Http\Controllers\AuthController@registerProses');

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('isLogin')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     Alert::toast('Email Berhasil Diverifikasi', 'success');
//     return redirect('/');
// })->name('verification.verify');


Route::middleware(['isLogin'])->group(function () {

    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
    Route::get('/alat', 'App\Http\Controllers\AlatController@index');
    Route::post('/alat', 'App\Http\Controllers\AlatController@store');
    Route::get('/alat/{id}', 'App\Http\Controllers\AlatController@show');
    Route::get('/alat/delete/{alat}', 'App\Http\Controllers\AlatController@destroy');

    Route::get('/working-order', 'App\Http\Controllers\WorkingOrderController@index');
    Route::get('/working-order/pengerjaan/{id}', 'App\Http\Controllers\WorkingOrderController@pengerjaan');
    Route::post('/working-order', 'App\Http\Controllers\WorkingOrderController@store');
    Route::get('/working-order/{id}', 'App\Http\Controllers\WorkingOrderController@show');
    Route::get('/working-order/delete/{id}', 'App\Http\Controllers\WorkingOrderController@destroy');

    Route::get('/profile', 'App\Http\Controllers\UserController@profile');
    Route::put('/profileUpdate', 'App\Http\Controllers\UserController@profileUpdate');
    Route::put('/updateAvatar', 'App\Http\Controllers\UserController@updateAvatar');
    Route::post('/insertUser', 'App\Http\Controllers\UserController@insertUser');
    Route::get('/user', 'App\Http\Controllers\UserController@index');
    Route::get('/user/{user}', 'App\Http\Controllers\UserController@deleteUser');
    Route::put('/updateUser/{user}', 'App\Http\Controllers\UserController@updateUser');
    Route::get('/user/detail/{id}', 'App\Http\Controllers\UserController@show');
    Route::put('/changePassword', 'App\Http\Controllers\UserController@changePassword');

    

    Route::get('/pengerjaan', 'App\Http\Controllers\PengerjaanController@index');
    Route::post('/pengerjaan', 'App\Http\Controllers\PengerjaanController@store');
    Route::get('/pengerjaan/deskripsi/{id}', 'App\Http\Controllers\PengerjaanController@insertDeskripsi');
    Route::post('/pengerjaan/deskripsi/insert', 'App\Http\Controllers\PengerjaanController@insertDeskripsiProses');
    Route::get('/pengerjaan/{id}', 'App\Http\Controllers\PengerjaanController@show');
    Route::get('/pengerjaan/edit/{pengerjaan}', 'App\Http\Controllers\PengerjaanController@edit');
    Route::put('/pengerjaan/{id}', 'App\Http\Controllers\PengerjaanController@update');
    Route::get('/pengerjaan/delete/{id}', 'App\Http\Controllers\PengerjaanController@destroy');

    Route::get('/teknisi', 'App\Http\Controllers\TeknisiController@index');
    Route::post('/teknisi', 'App\Http\Controllers\TeknisiController@store');
    Route::get('/teknisi/{id}', 'App\Http\Controllers\TeknisiController@show');
    Route::put('/teknisi/{id}', 'App\Http\Controllers\TeknisiController@update');
    Route::get('/teknisi/delete/{id}', 'App\Http\Controllers\TeknisiController@destroy');

    Route::get('/history', 'App\Http\Controllers\HistoryController@index');
    Route::post('/history', 'App\Http\Controllers\HistoryController@store');
    Route::get('/history/{id}', 'App\Http\Controllers\HistoryController@show');
    Route::get('/history/delete/{id}', 'App\Http\Controllers\HistoryController@destroy');

    Route::get('/deskripsi-pekerjaan', 'App\Http\Controllers\DeskirpsiPekerjaanController@index');
    // Route::post('/deskripsi-pekerjaan', 'App\Http\Controllers\DeskirpsiPekerjaanController@store');
    Route::put('/deskripsi/update/{id}', 'App\Http\Controllers\DeskirpsiPekerjaanController@update');
    // Route::get('/deskripsi-pekerjaan/{id}', 'App\Http\Controllers\DeskirpsiPekerjaanController@show');
    Route::get('/deskripsi-pekerjaan/delete/{alat}', 'App\Http\Controllers\DeskirpsiPekerjaanController@destroy');
});
