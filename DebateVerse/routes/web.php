<?php

use App\Http\Controllers\DebateController;
use App\Http\Controllers\UserController;
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

Route::middleware([\App\Http\Middleware\User::class])->group(function () {


    Route::get('/home', [\App\Http\Controllers\DebateController::class, 'home'])->name('home');

    //Admin and SuperAdmin Middleware

    Route::middleware([\App\Http\Middleware\Admin::class])->group(function () {

        //SuperAdmin Middleware

        Route::middleware([\App\Http\Middleware\SuperAdmin::class])->group(function () {

            //Suggestion

            Route::delete('/delete/suggestion/{suggestion}', [\App\Http\Controllers\SuggestionsToAdminController::class, 'destroy'])->name('delete.suggestion');

            //Admins Role

            Route::put('/change/role/{user}', [UserController::class, 'changeRole'])->name('change.role');
        });

        // suggestions

        Route::get('/suggestions', [\App\Http\Controllers\SuggestionsToAdminController::class, 'index'])->name('admin.suggestions');

        Route::get('/dashboard', [\App\Http\Controllers\DebateController::class, 'index'])->name('dashboard');

        //tag

        Route::get('/tags', [\App\Http\Controllers\TagController::class, 'toTags'])->name('tags');
        Route::post('/create/tag', [\App\Http\Controllers\TagController::class, 'store'])->name('add.tag');
        Route::delete('/destroy/tag/{tag}', [\App\Http\Controllers\TagController::class, 'destroy'])->name('destroy.tag');
        Route::put('/update/tag/{tag}', [\App\Http\Controllers\TagController::class, 'update'])->name('update.tag');

        //Users

        Route::get('/users', [\App\Http\Controllers\UserController::class, 'toUsers'])->name('users');
        Route::put('/user/ban/{user}', [\App\Http\Controllers\UserController::class, 'usersBan'])->name('user.ban');
    });

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
    Route::get('/find/debate/{tag}', [DebateController::class, 'findDebateByTag'])->name('find.debate.by.tag');

//Suggestion

    Route::get('/to/send/suggestion', [\App\Http\Controllers\SuggestionsToAdminController::class, 'toSendSuggestions'])->name('to.send.suggestions');
    Route::post('/send/suggestion', [\App\Http\Controllers\SuggestionsToAdminController::class, 'sendSuggestion'])->name('send.suggestion');

//Errors

    Route::get('/error', [DebateController::class, 'error'])->name('error404');
    Route::get('/error/403', [DebateController::class, 'error403'])->name('error403');

});
Route::get('/banned', [DebateController::class, 'bannedView'])->name('banned');


