
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Editar Usuario</h2>

        <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
            @csrf @method('PUT')

            <div>
                <label class="block">Nombre</label>
                <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name', $user->name) }}">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email', $user->email) }}">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <x-label for="role">Rol</x-label>
                <x-select name="role" :options="$roles" :selected="$userRole" />
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Actualizar</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">Cancelar</a>
        </form>
    </div>
</x-app-layout>