@props(['disabled' => false, 'help' => null])

<x-input-label for="{{ $attributes['name'] }}" :help="$help" :value="__(ucfirst($attributes['name'])) . (
  $attributes['required'] ? '*' : ''
)" />

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>

@error($attributes['name'])
  <p class="mt-2 text-xxs text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror
