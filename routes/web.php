<?php

use App\Http\Controllers\AuthController;
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
    return view('home');
});

Route::get('/home-admin', function () {
    return view('admin.home');
});

Route::get('/show', function () {
    return view('creations.show');
});


// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::post('/login-action', 'actionLogin')->name('actionLogin');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register-action', 'actionRegister')->name('actionRegister');
    Route::get('/logout', 'actionLogout')->name('logout');
});