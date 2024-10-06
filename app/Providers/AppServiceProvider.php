<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\TaskManager;
use App\Http\Livewire\ProjectManager;
use Livewire\Livewire;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\TaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );
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
