<?php
namespace App\Http\Livewire;

use App\Models\Task;
use App\Models\Project;
use Livewire\Component;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;

class TaskManager extends Component 
{
    public $tasks, $taskName, $taskId, $taskPriority, $projectId;
    public $projects;
    public $isEditing = false; 
    protected $taskRepository;

    
    public function boot(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function mount() 
    { 
        $this->tasks = $this->taskRepository->getAllTasksOrderedByPriority();
        $this->projects = Project::all();
    }

    public function reorderTasks($data)
    {
        $taskId = $data['id'];
        $newIndex = $data['newIndex'];
         
        $this->taskRepository->reorderTasks($taskId, $newIndex);
  
        $this->tasks = $this->taskRepository->getAllTasksOrderedByPriority();
    }

     
    public function createTask()
    {
        $this->validate([
            'taskName' => 'required|string|max:255',
            'taskPriority' => 'required|integer',
            'projectId' => 'nullable|exists:projects,id',
        ]);

        $this->taskRepository->createTask([
            'name' => $this->taskName,
            'priority' => $this->taskPriority,
            'project_id' => $this->projectId,
        ]);

        $this->resetInput();
        $this->tasks = $this->taskRepository->getAllTasksOrderedByPriority();
    }

    public function editTask($id)
    {
        $task = $this->taskRepository->findTaskById($id);
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

        $this->taskRepository->updateTask($this->taskId, [
            'name' => $this->taskName,
            'priority' => $this->taskPriority,
            'project_id' => $this->projectId,
        ]);

        $this->resetInput();
        $this->tasks = $this->taskRepository->getAllTasksOrderedByPriority();
        $this->isEditing = false;
    }

    public function deleteTask($id)
    {
        $this->taskRepository->deleteTask($id);
        $this->tasks = $this->taskRepository->getAllTasksOrderedByPriority();
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
