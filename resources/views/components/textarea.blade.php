@props(['disabled' => false, 'help' => null, 'editor' => false])

<x-input-label for="{{ $attributes['name'] }}" :help="$help" :value="__(ucfirst($attributes['name'])) . (
  $attributes['required'] ? '*' : ''
)" />

@if ($editor)
    <div
        x-data
        x-init="() => {
            const quill = new Quill($refs.quill, {
                theme: 'snow',
                modules: { toolbar: true }
            });

            const textarea = document.getElementById('{{ $attributes['name'] }}');
            quill.on('text-change', () => {
                textarea.value = quill.root.innerHTML;
            });

            quill.root.innerHTML = textarea.value;

            
        }"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
    >
        <div x-ref="quill" style="min-height: 150px;"></div>
        <textarea id="{{ $attributes['name'] }}" name="{{ $attributes['name'] }}" x-ref="input" hidden>{!! $attributes['value'] !!}</textarea>
    </div>
@else
    <textarea
        @disabled($disabled)
        {{ $attributes->merge([
            'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'
        ]) }}
    >{{ $attributes['value'] }}</textarea>
@endif

@error($attributes['name'])
  <p class="mt-2 text-xxs text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror
