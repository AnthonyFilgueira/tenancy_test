<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Crear Permiso</h1>

        <form action="{{ route('permissions.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Nombre</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ old('name') }}">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
        </form>
    </div>
</x-app-layout>
