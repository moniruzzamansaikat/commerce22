@props([
  'label'   => 'Toggle',
  'name'    => null,
  'checked' => 'false',
  'help'    => null
])

<div x-data="{ on: {{ $checked }} }" class="">
  <x-input-label for="{{ $attributes['name'] }}" :help="$help" :value="$label" />

  <button 
      @click="on = !on"
      :class="on 
          ? 'bg-indigo-600' 
          : 'bg-gray-300 dark:bg-gray-600'" 
      class="relative inline-flex h-6 mt-2 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500"
      type="button"
  >
      <input type="hidden" x-model="on" name="{{ $name }}" />
      <span 
          :class="on ? 'translate-x-6' : 'translate-x-1'" 
          class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform"
      ></span>
  </button>
</div>