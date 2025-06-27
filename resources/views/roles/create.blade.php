<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Nuevo Rol</h1>

        <form action="{{ route('roles.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Nombre</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Permisos</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($permissions as $permission)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                            <span>{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
