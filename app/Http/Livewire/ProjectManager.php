<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class ProjectManager extends Component
{
    public $newProjectName;
    public $projects;

    public function mount()
    {
        $this->projects = Project::all();
    }

    public function createProject()
    {
        $this->validate([
            'newProjectName' => 'required|string|max:255',
        ]);

        Project::create([
            'name' => $this->newProjectName,
        ]);

        $this->newProjectName = '';
        $this->projects = Project::all();
    }

    public function render()
    {
        return view('livewire.project-manager')
            ->layout('components.layouts.app');
    }
}
