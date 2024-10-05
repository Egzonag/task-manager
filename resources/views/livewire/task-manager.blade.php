<div class="flex justify-center items-center min-h-screen bg-gray-50">
    <div class="flex w-full max-w-6xl bg-white rounded-lg shadow p-6">
        <!-- Left side - Task form -->
        <div class="w-1/2 pr-6 border-r">
            <div class="text-right mb-4">
                <a href="{{ route('projects') }}" class="text-sm text-blue-500 hover:underline">Manage Projects</a>
            </div>

            <h1 class="text-xl font-bold text-center mb-6">Add / Edit Task</h1>

            <div class="space-y-3">
                <input type="text" wire:model="taskName" placeholder="Task Name" class="border rounded p-2 w-full focus:outline-none focus:ring focus:border-blue-300">
                <input type="number" wire:model="taskPriority" placeholder="Priority" class="border rounded p-2 w-full focus:outline-none focus:ring focus:border-blue-300">

                <select wire:model="projectId" class="border rounded p-2 w-full focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">Select Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>

                @if($isEditing) 
                    <button wire:click="updateTask" class="w-full bg-blue-500 text-white rounded p-2 hover:bg-blue-600">Update Task</button>
                @else
                    <button wire:click="createTask" class="w-full bg-blue-500 text-white rounded p-2 hover:bg-blue-600">Add Task</button>
                @endif
            </div>
        </div>

        <!-- Right side - Task list -->
        <div class="w-1/2 pl-6">
            <h1 class="text-xl font-bold text-center mb-6">Task List</h1>

            <ul id="task-list" class="mt-6 space-y-2">
                @foreach($tasks as $task)
                    <li class="flex justify-between items-center p-3 border rounded bg-gray-50"
                        draggable="true"
                        data-task-id="{{ $task->id }}"
                        ondragstart="drag(event)"
                        ondrop="drop(event)"
                        ondragover="allowDrop(event)"
                        class="draggable hover:bg-gray-200">
                        <div>
                            <strong>{{ $task->name }}</strong> (Priority: {{ $task->priority }})
                        </div>
                        <div class="space-x-2">
                            <button wire:click="editTask({{ $task->id }})" class="bg-yellow-400 text-white rounded px-3 py-1 hover:bg-yellow-500">Edit</button>
                            <button wire:click="deleteTask({{ $task->id }})" class="bg-red-500 text-white rounded px-3 py-1 hover:bg-red-600">Delete</button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
 <script>
   function drag(event) {
        event.dataTransfer.setData("text/plain", event.target.getAttribute("data-task-id"));
    }

    function drop(event) {
        event.preventDefault();
        const taskId = event.dataTransfer.getData("text/plain");
        const targetElement = event.target.closest('li');
        const taskList = document.getElementById('task-list');
        const newIndex = Array.from(taskList.children).indexOf(targetElement);
        
        @this.call('reorderTasks', { id: parseInt(taskId), newIndex: newIndex });
    }

    function allowDrop(event) {
        event.preventDefault();
    }
 </script>
 
