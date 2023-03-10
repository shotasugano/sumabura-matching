<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

//全()が可能なルート
Route::get('/login/twitter',[App\Http\Controllers\UserController::class, 'redirectToProvider'])->name('twitter.login');

Route::get('/login/twitter/callback', [App\Http\Controllers\UserController::class, 'handleProviderCallback']);
Route::get('/account/registmove', [App\Http\Controllers\UserController::class, 'registmove'])->name('registmove');
Route::get('/', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post('/account/regist', [App\Http\Controllers\UserController::class, 'regist'])->name('regist');
Route::post('/account/find', [App\Http\Controllers\UserController::class, 'find'])->name('find');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/statuses', [App\Http\Controllers\UserController::class, 'index'])->name('statuses');
Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::post('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::get('/instruction', [App\Http\Controllers\UserController::class, 'instruction']);
Route::get('/withdrawal', [App\Http\Controllers\UserController::class, 'withdrawal']);
Route::post('/withdrawal', [App\Http\Controllers\UserController::class, 'withdrawal']);