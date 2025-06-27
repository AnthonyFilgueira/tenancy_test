<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Roles</h1>
            <a href="{{ route('roles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nuevo Rol</a>
        </div>

        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Permisos</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $role->name }}</td>
                    <td class="px-4 py-2">
                        {{ $role->permissions->pluck('name')->join(', ') }}
                    </td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('roles.edit', $role) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</a>
                        <form method="POST" action="{{ route('roles.destroy', $role) }}" onsubmit="return confirm('¿Eliminar?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>
</x-app-layout>

