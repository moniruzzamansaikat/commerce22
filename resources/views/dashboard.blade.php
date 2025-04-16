<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($modules as $module)
                    <a href="{{ route($module['base_route']) }}"
                        class="inline-block text-center p-6 text-gray-900 dark:text-gray-100">
                        <div
                            class="dark:bg-gray-900 p-4 rounded-md bg-slate-200 inline-block hover:bg-slate-100 transition-all">
                            <img src="{{ $module['image'] }}" alt="@lang('Icon')" class="w-16 mb-2 m-auto">
                            <p class="text-2xl mb-2">{{ $module['name'] }}</p>
                            <p>{{ $module['description'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>