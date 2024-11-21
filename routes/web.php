<?php

use App\Livewire\Auth\LoginUser;
use App\Livewire\Auth\Logout;
use App\Livewire\Auth\RegisterUser;
use App\Livewire\HomeFeed;
use App\Livewire\Post\PostCreate;
use App\Livewire\Post\PostEdit;
use App\Livewire\Post\PostShow;
use App\Livewire\Profile\UserProfile;
use App\Livewire\Profile\UserProfileEdit;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeFeed::class)->name('home');
Route::get('/register', RegisterUser::class)->name('register');
Route::get('/login', LoginUser::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', PostCreate::class)->name('posts.create');
    Route::get('/posts/{post}', PostShow::class)->name('posts.show');
    Route::get('/posts/{post}/edit', PostEdit::class)->name('posts.edit');

    Route::get('/profile/{user:username}', UserProfile::class)->name('profile.index');
    Route::get('/profile/{user:username}/edit', UserProfileEdit::class)->name('profile.edit');
    Route::get('/logout', Logout::class)->name('logout');
});
