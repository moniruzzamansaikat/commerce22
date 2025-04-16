@props([
    'name',
    'label' => 'Category Image',
    'accept' => '',
])

<div class="flex flex-col items-start w-full">
    <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-200 w-1/3">{{ __($label) }}</label>

    <!-- File input with consistent styles -->
    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="{{ $accept }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm cursor-pointer">

    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
