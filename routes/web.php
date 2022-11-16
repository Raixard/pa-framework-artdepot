<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CreationController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Creation;
use App\Models\Follow;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
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

// Creation Controller
Route::controller(CreationController::class)->group(function () {
    Route::get('/', 'home')->name('home');

    Route::get('/followed', 'showFollowed')->name('creationShowFollowed')->middleware('auth');
    Route::get('/search', 'search')->name('creationSearch')->middleware('auth');

    Route::get('/creation/{id}', 'show')->name('creationShow');
    Route::get('/creation/{id}/edit', 'edit')->name('creationEdit')->middleware('auth');
    Route::put('/creation/{id}', 'update')->name('creationUpdate')->middleware('auth');
    Route::delete('/creation/{id}', 'destroy')->name('creationDestroy')->middleware('auth');

    Route::get('/creation-create', 'create')->name('creationCreate')->middleware('auth');
    Route::post('/creation-store', 'store')->name('creationStore')->middleware('auth');
});

// Comment Controller
Route::controller(CommentController::class)->group(function () {
    Route::post('/creation/{id}/comment', 'store')->name('commentStore')->middleware('auth');
    Route::delete('/creation/{id}/comment/{comment_id}', 'destroy')->name('commentDestroy')->middleware('auth');
});

// Like Controller
Route::controller(LikeController::class)->group(function () {
    Route::post('/creation/{id}/like', 'store')->name('likeStore')->middleware('auth');
    Route::delete('/creation/{id}/like', 'destroy')->name('likeDestroy')->middleware('auth');
});

// Follow Controller
Route::controller(FollowController::class)->group(function () {
    Route::post('/user/{id}/follow', 'store')->name('followStore')->middleware('auth');
    Route::delete('/user/{id}/follow', 'destroy')->name('followDestroy')->middleware('auth');
});

// User Controller
Route::controller(UserController::class)->group(function () {
    Route::get('/user/{username}', 'show')->name('userShow');
    Route::get('/user/{username}/liked', 'showLiked')->name('userShowLiked');
    Route::get('/user/{username}/followers', 'showFollowers')->name('userShowFollowers');
    Route::get('/user/{username}/followings', 'showFollowings')->name('userShowFollowings');
    Route::get('/user/{username}/edit', 'edit')->name('userEdit')->middleware('auth');
    Route::put('/user/{username}/update', 'update')->name('userUpdate')->middleware('auth');
});

// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::post('/login-action', 'actionLogin')->name('actionLogin');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register-action', 'actionRegister')->name('actionRegister');
    Route::get('/logout', 'actionLogout')->name('logout');
});

// Categories Controller
Route::controller(CategoryController::class)->group(function(){
    Route::get('/category', 'index')->name('category');
    Route::get('/category/show/{id}', 'show')->name('showCategory');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/report', 'showReport')->name('report');
    Route::get('/admin/akun', 'showAkun')->name('akun');
    Route::post('/report/kirim', 'simpan')->name('sendReport');
    Route::post('/akun/status/{id}/banned', 'banned')->name('bannedAkun');
    Route::post('/akun/status/{id}/unbanned', 'unbanned')->name('unbannedAkun');
});
