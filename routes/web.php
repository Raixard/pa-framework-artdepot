<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CreationController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Models\Creation;
use App\Models\Follow;
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

Route::get('/', function () {
    return view('home', [
        'creations' => Creation::all()->sortByDesc('id'),
    ]);
});

Route::get('/home-admin', function () {
    return view('admin.home');
});

Route::get('/followed', function () {
    $followedId = Follow::where('follower_id', Auth::user()->id)->pluck('id');

    return view('home', [
        'creations' => Creation::whereIn('id', $followedId)->get(),
    ]);
})->name('creationFollowed')->middleware('auth');

// Creation Controller
Route::controller(CreationController::class)->group(function () {
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
Route::controller(CreationController::class)->group(function () {
    Route::get('/user/{username}', 'show')->name('userShow');
    Route::get('/user/{username}/liked', 'showLiked')->name('userShowLiked');
});

// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::post('/login-action', 'actionLogin')->name('actionLogin');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register-action', 'actionRegister')->name('actionRegister');
    Route::get('/logout', 'actionLogout')->name('logout');
});
