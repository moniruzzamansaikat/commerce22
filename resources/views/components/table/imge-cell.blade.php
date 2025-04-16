@props([
  'image' => null
])

@if ($image)
  <img src="{{ $image }}" alt="thumb" class="h-12 w-12 object-cover rounded-full">
@else
  <span class="text-gray-500">{{ __('No Image') }}</span>
@endif