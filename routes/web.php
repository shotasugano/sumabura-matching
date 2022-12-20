<?php

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


Route::get('/', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/account/registmove', [App\Http\Controllers\UserController::class, 'registmove'])->name('registmove');
Route::post('/account/regist', [App\Http\Controllers\UserController::class, 'regist'])->name('regist');
Route::post('/account/find', [App\Http\Controllers\UserController::class, 'find'])->name('find');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/statuses', [App\Http\Controllers\UserController::class, 'index'])->name('statuses');
Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::post('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::get('/instruction', [App\Http\Controllers\UserController::class, 'instruction']);