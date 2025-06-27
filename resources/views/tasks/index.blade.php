<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">My Tasks</h1>

        <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Create Task</a>

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Due Date</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td class="px-4 py-2 border">{{ $task->title }}</td>
                        <td class="px-4 py-2 border capitalize">{{ str_replace('_', ' ', $task->status) }}</td>
                        <td class="px-4 py-2 border">{{ $task->due_date }}</td>
                        <td class="px-4 py-2 border">
                            
                            @can('update_task')
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-500 mr-2">Edit</a>
                            @endcan
                            @can('destroy_task')
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500" onclick="return confirm('Delete this task?')">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-2 text-center">No tasks found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>