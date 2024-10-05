<?php
namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\Project;
use Livewire\Component;

class TaskManager extends Component
{
    public $tasks, $taskName, $taskId, $taskPriority, $projectId;
    public $projects;
    public $isEditing = false;

    public function mount()
    {
        $this->tasks = Task::orderBy('priority')->get();
        $this->projects = Project::all();
    }

    public function reorderTasks($data)
    {
        $taskId = $data['id'];
        $newIndex = $data['newIndex'];
     
        $task = Task::find($taskId);
        $currentPriority = $task->priority;
     
        if ($newIndex + 1 < $currentPriority) { 
            Task::where('priority', '>=', $newIndex + 1)
                ->where('priority', '<', $currentPriority)
                ->increment('priority');
        } elseif ($newIndex + 1 > $currentPriority) { 
            Task::where('priority', '>', $currentPriority)
                ->where('priority', '<=', $newIndex + 1)
                ->decrement('priority');
        }
     
        $task->update(['priority' => $newIndex + 1]);
     
        $this->tasks = Task::orderBy('priority')->get();
    }
    

    public function createTask()
    {
        $this->validate([
            'taskName' => 'required|string|max:255',
            'taskPriority' => 'required|integer',
            'projectId' => 'nullable|exists:projects,id',
        ]);

        Task::create([
            'name' => $this->taskName,
            'priority' => $this->taskPriority,
            'project_id' => $this->projectId,
        ]);

        $this->resetInput();
        $this->tasks = Task::orderBy('priority')->get();
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        $this->taskId = $task->id;
        $this->taskName = $task->name;
        $this->taskPriority = $task->priority;
        $this->projectId = $task->project_id;
        $this->isEditing = true;
    }

    public function updateTask()
    {
        $this->validate([
            'taskName' => 'required|string|max:255',
            'taskPriority' => 'required|integer',
            'projectId' => 'nullable|exists:projects,id',
        ]);

        $task = Task::find($this->taskId);
        $task->update([
            'name' => $this->taskName,
            'priority' => $this->taskPriority,
            'project_id' => $this->projectId,
        ]);

        $this->resetInput();
        $this->tasks = Task::orderBy('priority')->get();
        $this->isEditing = false;
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
        $this->tasks = Task::orderBy('priority')->get();
    }

    public function resetInput()
    {
        $this->taskName = '';
        $this->taskId = '';
        $this->taskPriority = '';
        $this->projectId = null;
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
