<?php

namespace Modules\Commerce\Services;

use Illuminate\Support\Facades\Storage;
use Modules\Commerce\Models\Product;

class ProductService
{
    public function handle($request, $id)
    {
        $rules = [
            'name'        => 'required|unique:products',
            'price'       => 'required|numeric|gte:0',
            'old_price'   => 'nullable|numeric|gte:0',
            'cost'        => 'nullable|numeric|gte:0',
            'short_desc'  => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'sku'         => 'nullable|unique:products',
            'desc'        => 'nullable',
        ];

        if ($id) {
            $rules['name'] = 'required|unique:products,name,' . $id . ',id';
        }

        $request->validate($rules);

        $product = $id ? Product::findOrFail($id) : new Product();

        $product->name            = $request->name;
        $product->slug            = str($product->name)->slug();
        $product->cost            = $request->cost;
        $product->price           = $request->price;
        $product->old_price       = $request->old_price;
        $product->short_desc      = $request->short_desc;
        $product->desc            = $request->desc;
        $product->is_new          = $request->boolean('is_new');
        $product->is_published    = $request->boolean('is_published');
        $product->non_returnable  = $request->boolean('non_returnable');
        $product->is_downloadable = $request->boolean('is_downloadable');
        $product->category_id     = $request->category_id;

        if ($request->hasFile('image')) {
            if ($id && $product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('uploads/products', 'public');
            $product->image = $imagePath;
        }

        $product->save();
    }
}
