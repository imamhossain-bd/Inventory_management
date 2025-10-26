<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use App\Models\SubCategories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{

    public function index()
    {
        $subCategories = SubCategories::all();
        return view('backend.sub_categories.index', compact('subCategories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('backend.sub_categories.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sub_categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'category_code' => 'nullable|string|max:100',
        ]);

        $slug = $request->slug ?? Str::slug($request->name);

        $subCategories = SubCategories::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status ?? 1,
            'category_id' => $request->category_id,
            'category_code' => $request->category_code,
        ]);

        // Image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/sub_categories', $filename, 'public');
            $subCategories->update(['image' => $path,]);
            $subCategories->save();
        }

        return redirect()->route('backend.sub_categories.index')
            ->with('success', 'Sub-category created successfully.');
    }



    public function show($id)
    {
        $subCategory = SubCategories::with('category')->findOrFail($id);
        return view('backend.sub_categories.show', compact('subCategory'));
    }



    public function edit(SubCategories $subCategories)
    {
        $categories = Category::all();
        return view('backend.sub_categories.edit', compact('categories', 'subCategories'));
    }


    public function update(Request $request, SubCategories $subCategories)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:sub_categories,slug,' . $subCategories->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'category_code' => 'nullable|string|max:100',
        ]);

        $subCategories->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status ?? $subCategories->status,
            'category_id' => $request->category_id,
            'category_code' => $request->category_code,
        ]);


        if ($request->hasFile('image')) {
            $$file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/sub_categories', $filename, 'public');
            $subCategories->update(['image' => $path]);
        }


        return redirect()->route('backend.sub_categories.index')->with('success', 'Sub-category updated successfully.');
    }


    public function destroy(SubCategories $subCategories)
    {
        $subCategories->delete();
        return redirect()->route('backend.sub_categories.index')->with('success', 'Sub-category deleted successfully.');
    }
}
