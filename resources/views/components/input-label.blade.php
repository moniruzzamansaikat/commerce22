@props(['value' => null, 'help' => null])

<label {{ $attributes->merge(['class' => 'inline-block flex gap-2 items-center font-medium text-sm text-gray-700 dark:text-gray-300']) }} class="flex items-center gap-1 relative group">
    {{ $value ? str_replace('_', ' ', ucfirst($value)) : $slot }}

    @if ($help)
        <div 
            x-data="{ show: false }" 
            @mouseenter="show = true" 
            @mouseleave="show = false" 
            class="relative cursor-pointer text-gray-400 hover:text-gray-600 dark:hover:text-gray-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>

            <div 
                x-show="show" 
                x-transition 
                class="absolute ml-2  w-max max-w-xs px-3 py-1.5 text-xs text-white bg-gray-800 rounded shadow z-50"
                style="white-space: normal;"
            >
                {{ $help }}
            </div>
        </div>
    @endif
</label>
