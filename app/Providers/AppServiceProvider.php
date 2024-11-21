<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('logout', \App\Livewire\Auth\Logout::class);
        // Livewire::component('avatar-update-form', \App\Livewire\Profile\AvatarUpdateForm::class);
    }
}
