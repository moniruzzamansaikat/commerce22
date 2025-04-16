<form x-data="{saveAndNew: false}" action="{{ @$edit ? route('commerce.product.store', $product->id) : route('commerce.product.store') }}"
  method="POST" enctype="multipart/form-data" class="mt-4">
  @csrf

  <input type="hidden" x-model="saveAndNew" name="save_and_new">

  <div class="mt-6 text-end">
    <x-primary-button type="submit">
      {{ __('Save') }}
    </x-primary-button>
    <x-primary-button type="submit" @click="saveAndNew = true">
      {{ __('Save & Stay') }}
    </x-primary-button>
  </div>


  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="justify-self-center  w-full col-span-full">
      <x-text-input id="name" name="name" type="text" class="w-full mt-2" :value="old('name', @$product->name)"
        required />
    </div>

    <div class="col-span-full grid grid-cols-1 md:grid-cols-3 gap-6">
      <div>
        <x-text-input id="price" step="0.01" name="price" class="w-full mt-2" :value="old('price', getAmount(@$product->price))" type="number" required />
      </div>

      <div>
        <x-text-input id="old_price" step="0.01" help="Old price will show differnce with the current price" name="old_price" class="w-full mt-2" :value="old('old_price', getAmount(@$product->old_price))" type="number" />
      </div>
      
      <div>
        <x-text-input id="cost" name="cost" step="0.01" class="w-full mt-2" :value="old('cost', getAmount(@$product->cost))" type="number" />
      </div>
    </div>

        
    <div>
      @php 
        $catOptions = [];
        
        foreach($categories as $cat)
        {
          $catOptions[$cat->id] = $cat->name;
        }
      @endphp
      <x-select-field 
        name="category_id" 
        :options="$catOptions" 
        :selected="@$product->category_id" 
        label="{{ __('Categroy') }}" 
        class="mt-1"
        required
      />
      @error('category_id')
          <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
      @enderror

  </div>

  <div>
    <x-text-input id="sku" name="sku" type="text" class="w-full mt-2" :value="old('sku', @$product->sku)"/>
  </div>

    <div class="col-span-full grid grid-cols-1 md:grid-cols-4 gap-6">
      <div>
        <x-toggle label="Published" name="is_published" :checked="@$product->is_published" help="Check if product is published or not" />
      </div>

      <div>
        <x-toggle label="New Product" name="is_new" :checked="@$product->is_new" help="It will show a badge on product as new, best for promoting product" />
      </div>
      
      <div>
        <x-toggle label="Non Returnable" name="non_returnable" :checked="@$product->non_returnable" help="Check if the product is not returnable after a sell" />
      </div>

      <div>
        <x-toggle label="Downloadable" name="is_downloadable" :checked="@$product->is_downloadable" help="Check if the product is Downloadable" />
      </div>
    </div>

    <div class="col-span-full">
      <x-textarea id="short_desc"  name="short_desc" type="text" class="w-full mt-2" :value="old('short_desc', @$product->short_desc)" />
    </div>

    <div class="col-span-full">
      <x-textarea id="desc" :editor="true" name="desc" type="text" class="w-full mt-2" :value="old('desc', @$product->desc)" />
    </div>


  </div>

</form>