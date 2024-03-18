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

Route::get('/', [\App\Http\Controllers\AuthController::class, 'toLogin'])->name('to.login');
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'toRegister'])->name('to.register');
Route::post('/user/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/user/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
