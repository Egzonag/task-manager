<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <a href="{{ url('/') }}" class="text-blue-500 hover:underline mb-4 block text-right">Go to Task Manager</a>
        
        <h2 class="text-2xl font-bold text-center mb-4">Project Manager</h2>
        <input type="text" wire:model="newProjectName" placeholder="New Project Name" class="border rounded p-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">

        <button wire:click="createProject" class="bg-green-500 hover:bg-green-600 text-white rounded p-2 w-full mb-4">
            Add Project
        </button>

        <ul class="space-y-2">
            @foreach($projects as $project)
                <li class="flex justify-between items-center p-2 border rounded bg-gray-50">
                    <span>{{ $project->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
