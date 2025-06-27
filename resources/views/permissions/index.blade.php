<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Permisos</h1>
            <a href="{{ route('permissions.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nuevo Permiso</a>
        </div>

        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-2 text-left">Nombre</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $permission->name }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('permissions.edit', $permission) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</a>
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" onsubmit="return confirm('¿Eliminar este permiso?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $permissions->links() }}
        </div>
    </div>
</x-app-layout>
