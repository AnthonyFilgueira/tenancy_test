<x-guest-layout>
    <h3>Modulo Tenant</h3>
    <form method="POST" action="{{ route('tenants.store') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="tenant_id" value="tenant_id" />

            <x-text-input id="tenant_id" name="tenant_id" class="block mt-1 w-full"/>

            <x-input-error :messages="$errors->get('tenant_id')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                Enviar
            </x-primary-button>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl shadow-md">
        <thead class="bg-gray-200 text-gray-700 text-left text-sm uppercase font-semibold">
            <tr>
            <th class="px-6 py-3">Tenant ID</th>
            <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            
            @foreach ($tenants as $tenant)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{$tenant->id }}</td>
                    <td class="px-6 py-4">
                        <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg 
                                            xmlns="http://www.w3.org/2000/svg" 
                                            class="h-4 w-4 text-gray-400" 
                                            viewBox="0 0 20 20" 
                                            fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 
                                                2 0 014 0zM12 10a2 2 0 11-4 0 
                                                2 2 0 014 0zM16 12a2 2 0 
                                                100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <form method="POST" action="{{ route('tenants.destroy', $tenant) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('tenants.destroy', $tenant)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{  __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                        <button class="text-red-600 hover:text-red-800" title="Eliminar">
                        <i data-feather="trash-2"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</x-guest-layout>
