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

Route::get('/home', [\App\Http\Controllers\CategorieController::class, 'home'])->name('home');

Route::get('/dashboard', [\App\Http\Controllers\CategorieController::class, 'index'])->name('dashboard');
Route::get('/categories', [\App\Http\Controllers\CategorieController::class, 'toCategories'])->name('categories');

Route::post('/create/categorie', [\App\Http\Controllers\CategorieController::class, 'store'])->name('add.categorie');
Route::delete('/destroy/categorie/{categorie}', [\App\Http\Controllers\CategorieController::class, 'destroy'])->name('destroy.categorie');
Route::put('/update/categorie{categorie}', [\App\Http\Controllers\CategorieController::class, 'update'])->name('update.categorie');
