<?php

use App\Http\Controllers\DebateController;
use App\Http\Controllers\VotingController;
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


//login and register and home amd dashboard

Route::get('/', [\App\Http\Controllers\AuthController::class, 'toLogin'])->name('to.login');
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'toRegister'])->name('to.register');
Route::post('/user/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/user/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/home', [\App\Http\Controllers\DebateController::class, 'home'])->name('home');

Route::get('/dashboard', [\App\Http\Controllers\CategorieController::class, 'index'])->name('dashboard');

//categorie

Route::get('/categories', [\App\Http\Controllers\CategorieController::class, 'toCategories'])->name('categories');
Route::post('/create/categorie', [\App\Http\Controllers\CategorieController::class, 'store'])->name('add.categorie');
Route::delete('/destroy/categorie/{categorie}', [\App\Http\Controllers\CategorieController::class, 'destroy'])->name('destroy.categorie');
Route::put('/update/categorie{categorie}', [\App\Http\Controllers\CategorieController::class, 'update'])->name('update.categorie');

//tag

Route::get('/tags', [\App\Http\Controllers\TagController::class, 'toTags'])->name('tags');
Route::post('/create/tag', [\App\Http\Controllers\TagController::class, 'store'])->name('add.tag');
Route::delete('/destroy/tag/{tag}', [\App\Http\Controllers\TagController::class, 'destroy'])->name('destroy.tag');
Route::put('/update/tag/{tag}', [\App\Http\Controllers\TagController::class, 'update'])->name('update.tag');

//users profile

Route::get('/profile', [\App\Http\Controllers\UserController::class, 'index'])->name('profile');
Route::put('/update/user', [\App\Http\Controllers\UserController::class, 'update'])->name('update.user');
Route::get('/profile/{user}', [\App\Http\Controllers\UserController::class, 'friendProfile'])->name('users.profile');

//debate

Route::post('/create/debate', [\App\Http\Controllers\DebateController::class, 'store'])->name('create.debate');
Route::delete('/delete/debate/{debate}', [\App\Http\Controllers\DebateController::class, 'destroy'])->name('delete.debate');
Route::put('/update/debate/{debate}', [\App\Http\Controllers\DebateController::class, 'update'])->name('update.debate');
Route::post('/report/{debate}', [\App\Http\Controllers\DebateController::class, 'report'])->name('report');

//voting

Route::get('/with/{debate}', [VotingController::class, 'withUsers'])->name('with');
Route::get('/against/{debate}', [VotingController::class, 'againstUsers'])->name('against');

//Comment

Route::post('/comment/{debate}', [\App\Http\Controllers\CommentController::class, 'storeComment'])->name('comment');
Route::delete('/delete/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'destroyComment'])->name('destroy.comment');
Route::put('/update/comment/{comment}', [\App\Http\Controllers\CommentController::class, 'updateComment'])->name('update.comment');

//Friend Request

Route::get('/friends', [\App\Http\Controllers\FriendController::class, 'toFriends'])->name('friends');
Route::post('/send/friend/request/{user}', [\App\Http\Controllers\FriendController::class, 'store'])->name('send.friend.request');
Route::put('/accept/request/friend/{user}', [\App\Http\Controllers\FriendController::class, 'acceptRequest'])->name('accept.request.friend');
Route::delete('/reject/request/friend/{user}', [\App\Http\Controllers\FriendController::class, 'rejectRequest'])->name('reject.request.friend');
Route::delete('/remove/friend/{user}', [\App\Http\Controllers\FriendController::class, 'removeFriend'])->name('remove.friend');

//Chat

Route::get('/contact', [\App\Http\Controllers\MessageController::class, 'toContact'])->name('contact');
Route::get('/chat/{user}', [\App\Http\Controllers\MessageController::class, 'toChat'])->name('chat');
Route::post('/send/message/{user}', [\App\Http\Controllers\MessageController::class, 'sendMessage'])->name('send.message');


Route::delete('/delete/notification/{notification}', [\App\Http\Controllers\NotificationController::class, 'destroyNotification'])->name('destroy.notification');
Route::delete('/destroy/notifications', [\App\Http\Controllers\NotificationController::class, 'destroyNotifications'])->name('destroy.notifications');

//Search

Route::get('/find/user/', [\App\Http\Controllers\UserController::class, 'findUser'])->name('find.user');
Route::get('/find/debate/{tag}', [DebateController::class, 'findDebate'])->name('find.debate.by.tag');
//Errors

Route::get('/error', [DebateController::class, 'error'])->name('error404');
