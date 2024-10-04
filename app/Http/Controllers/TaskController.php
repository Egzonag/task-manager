<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Listing tasks
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();
        return response()->json($tasks);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
            'project_id' => 'nullable|exists:projects,id',
        ]);
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'priority' => 'required|integer',
            'project_id' => 'nullable|exists:projects,id',
        ]);
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
