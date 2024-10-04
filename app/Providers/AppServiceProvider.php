<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\TaskManager;
use App\Http\Livewire\ProjectManager;
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
        Livewire::component('task-manager', TaskManager::class);
        Livewire::component('project-manager', ProjectManager::class);

    }
}
