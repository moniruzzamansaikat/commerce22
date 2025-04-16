<?php

namespace Modules\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Commerce\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(request()->get('per_page', 10));
        return view('commerce::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('commerce::category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id = null)
    {
        $rules = [
            'name'   => 'required|unique:categories',
            'slug'   => 'required|unique:categories',
            'status' => 'nullable|in:1,0',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // image validation
        ];
    
        if ($id) {
            $rules['name'] = 'required|unique:categories,name,' . $id . ',id';
            $rules['slug'] = 'required|unique:categories,slug,' . $id . ',id';
        }
    
        $request->validate($rules);
    
        $category = $id ? Category::findOrFail($id) : new Category();
    
        $category->name   = $request->name;
        $category->status = $request->status;
        $category->slug   = $request->slug;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            if ($id && $category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            
            $imagePath = $request->file('image')->store('uploads/categories', 'public');
            $category->image = $imagePath;
        }
    
        $category->save();
    
        return to_route('commerce.category.index')->withSuccess(trans('Category saved successfully.'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('commerce::category.edit', compact('category'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return back();
    }
}
