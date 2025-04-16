@props([
  'route' => null,
])

<form action="{{ $route }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you to continue?');">
  @csrf
  @method('DELETE')
  <button type="submit"
      class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
</form>
