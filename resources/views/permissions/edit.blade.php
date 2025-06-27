<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Editar Permiso</h1>

        <form action="{{ route('permissions.update', $permission) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block mb-1 font-medium">Nombre</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name', $permission->name) }}">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
        </form>
    </div>
</x-app-layout>
