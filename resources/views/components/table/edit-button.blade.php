@props([
  'href' => null
])

<a 
  href="{{ $href }}"
  class="text-blue-600 hover:text-blue-900">{{ __('Edit') }}</a>
