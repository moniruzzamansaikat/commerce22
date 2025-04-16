@if (Module::findOrFail('commerce')->isEnabled())   
  <x-nav-link :href="route('commerce.product.index')" :active="request()->routeIs('commerce.product*')">
      {{ __('Products') }}
  </x-nav-link>

  <x-nav-link :href="route('commerce.category.index')" :active="request()->routeIs('commerce.category*')">
      {{ __('Categories') }}
  </x-nav-link>
@endif
