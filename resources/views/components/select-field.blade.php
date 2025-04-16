@props([
  'name',
  'label' => __('Status'),
  'selected' => null,
  'options' => [
    '1' => 'Active',
    '0' => 'Disabled'
  ],
  'help' => null,
  'class' => '', // allow passing custom classes like 'w-full'
])


<div class="{{ $class }}">
  <x-input-label for="{{ $attributes['name'] }}" :help="$help" :value="__($label) . (
  $attributes['required'] ? '*' : ''
)" />
  <div class="relative">
    <select name="{{ $name }}" id="{{ $name }}" class="peer appearance-none block w-full px-3 mt-1 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-600">
        @foreach ($options as $value => $label)
          <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>{{ __($label) }}</option>
        @endforeach
    </select>

    <!-- Custom arrow -->
    <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M6 9l4 4 4-4"></path>
    </svg>
  </div>

  @error($name)
      <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
  @enderror
</div>
