<form action="{{ @$edit ? route('commerce.category.store', $category->id) : route('commerce.category.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
  @csrf

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
          <x-text-input 
            id="name" 
            name="name" 
            type="text" 
            class="w-full mt-2"
            :value="old('name', @$category->name)" 
            required 
           />
        </div>

        <div>
          <x-text-input 
            id="slug" 
            name="slug" 
            type="text" 
            class="w-full mt-2"
            :value="old('slug', @$category->slug)" 
            required 
           />
        </div>

      <div>
          <x-select-field :name="'status'" :options="['1' => 'Active', '0' => 'Disabled']" :selected="@$category->status" label="{{ __('Status') }}" />
          @error('status')
              <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
          @enderror
      </div>
      
      <x-file-input name="image" label="{{ __('Category Image') }}" accept="image/*" />
      
  </div>

  <!-- Submit Button -->
  <div class="mt-6 text-end">
      <x-primary-button type="submit">
          {{ __('Submit') }}
      </x-primary-button>
  </div>
</form>