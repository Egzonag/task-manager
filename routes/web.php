<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProjectManager;
use App\Http\Livewire\TaskManager;

Route::get('/', TaskManager::class)->name('task-manager');
Route::get('/projects', ProjectManager::class)->name('projects');
