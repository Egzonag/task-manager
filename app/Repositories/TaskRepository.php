<?php

namespace App\Repositories;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface 
{
    public function getAllTasksOrderedByPriority()
    {
        return Task::orderBy('priority')->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function findTaskById($id)
    {
        return Task::find($id);
    }

    public function updateTask($id, array $data)
    {
        $task = $this->findTaskById($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
    }

    public function reorderTasks(int $taskId, int $newIndex)
    {  
        DB::transaction(function () use ($taskId, $newIndex) {
            $task = $this->findTaskById($taskId);
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
        });
    }
}
