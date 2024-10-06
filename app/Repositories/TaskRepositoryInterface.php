<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getAllTasksOrderedByPriority();
    public function createTask(array $data);
    public function findTaskById($id);
    public function updateTask($id, array $data);
    public function deleteTask($id);
    public function reorderTasks(int $taskId, int $newIndex);
}
