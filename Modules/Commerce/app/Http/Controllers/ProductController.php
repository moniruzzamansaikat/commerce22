<?php

namespace Modules\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Commerce\Models\Category;
use Modules\Commerce\Models\Product;
use Modules\Commerce\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(request()->get('per_page', 10));

        return view('commerce::product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('commerce::product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id = null)
    {
        $this->productService->handle($request, $id);

        if ($request->boolean('save_and_new')) {
            return back()->withSuccess(trans('Product saved successfully.'));
        }

        return to_route('commerce.product.index')->withSuccess(trans('Product saved successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        
        return view('commerce::product.edit', compact('product', 'categories'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return back();
    }

}
