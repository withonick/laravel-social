<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authorization\RegisterController;
use App\Http\Controllers\Authorization\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Adm\AdminController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\Adm\UserController;

Route::middleware('hasrole:admin, moderator')->group(function (){
    Route::get('/control', [AdminController::class, 'index'])->name('control.index');
    Route::get('/control/users', [AdminController::class, 'users'])->name('control.users');
    Route::get('/control/users/confirmations', [AdminController::class, 'confirm'])->name('control.users.confirm');
    Route::get('/control/posts', [AdminController::class, 'posts'])->name('control.posts');
    Route::get('/control/complains', [AdminController::class, 'complains'])->name('control.complains');

    Route::put('/control/users/{user}/ban', [UserController::class, 'ban'])->name('user.ban');
    Route::put('/control/users/{user}/unban', [UserController::class, 'unban'])->name('user.unban');

});

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/settings', [IndexController::class, 'settings'])->name('settings');
Route::get('/lang/{lang}', [LangController::class, 'switchLang'])->name('switch.lang');


//Auth::routes();

Route::middleware('auth')->group(function (){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/profile/edit/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/updateimg', [ProfileController::class, 'updateimg'])->name('profile.updateimg');
    Route::post('/profile/image', [ProfileController::class, 'profile_img'])->name('profile.image');
    Route::post('/profile/subscribe/{user}', [SubscribeController::class, 'subscribe'])->name('subscribe');

    Route::put('/profile/money', [ProfileController::class, 'addMoney'])->name('profile.money');

    Route::put('/profile/{user}/buy', [ProfileController::class, 'buy'])->name('profile.buy');

    Route::get('/posts/complain/{post}', [PostController::class, 'complainform'])->name('posts.complain.form');
    Route::post('/posts/complain', [PostController::class, 'complain'])->name('posts.complain');
    Route::post('/posts/rate/{post}', [PostController::class, 'rate'])->name('posts.rate');

    Route::resource('/posts', PostController::class)->except('show', 'index');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/comment/update', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}/delete', [CommentController::class, 'destroy'])->name('comment.delete');

    Route::get('/messenger', [MessengerController::class, 'index'])->name('messenger.index');
    Route::get('/messenger/{user}', [MessengerController::class, 'show'])->name('messenger.show');
    Route::post('/messenger', [MessengerController::class, 'store'])->name('messenger.store');
    Route::delete('/messenger/{message}/delete', [MessengerController::class, 'destroy'])->name('messenger.delete');

    Route::post('/settings/verify', [ProfileController::class, 'verify'])->name('profile.verify');
});

Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::resource('/posts', PostController::class)->only('show', 'index');
