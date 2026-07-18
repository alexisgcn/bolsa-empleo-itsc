<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Vacantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('empresa.vacantes.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700">
                    {{ __('Nueva Vacante') }}
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr class="text-left text-xs uppercase text-gray-500 dark:text-gray-400">
                            <th class="px-6 py-3">Título</th>
                            <th class="px-6 py-3">Estado</th>
                            <th class="px-6 py-3">Postulaciones</th>
                            <th class="px-6 py-3">Cierre</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-900 dark:text-gray-100">
                        @forelse ($vacantes as $vacante)
                            <tr>
                                <td class="px-6 py-4">{{ $vacante->titulo }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($vacante->estado === 'publicada') bg-green-100 text-green-800
                                        @elseif($vacante->estado === 'borrador') bg-yellow-100 text-yellow-800
                                        @else bg-gray-200 text-gray-700 @endif">
                                        {{ ucfirst($vacante->estado) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $vacante->postulaciones_count }}</td>
                                <td class="px-6 py-4">{{ $vacante->fecha_cierre ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Todavía no has creado ninguna vacante.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>