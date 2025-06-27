<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-6">
        <h2 class="text-xl font-semibold mb-4">Crear Usuario</h2>

        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block">Nombre</label>
                <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name') }}">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" value="{{ old('email') }}">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block">Contraseña</label>
                <input type="password" name="password" class="w-full border p-2 rounded">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <x-label for="role">Rol</x-label>
                <x-select name="role" :options="$roles" />
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Crear</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">Cancelar</a>
        </form>
    </div>
</x-app-layout>
