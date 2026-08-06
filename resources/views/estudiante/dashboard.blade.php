<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Panel de Estudiante') }}

                    <div class="mt-4 space-x-4">
                        <a href="{{ route('estudiante.vacantes.index') }}" class="underline text-indigo-600">Ver vacantes</a>
                        <a href="{{ route('estudiante.postulaciones.index') }}" class="underline text-indigo-600">Mis postulaciones</a>
                        <a href="{{ route('estudiante.perfil.edit') }}" class="underline text-indigo-600">Mi perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>