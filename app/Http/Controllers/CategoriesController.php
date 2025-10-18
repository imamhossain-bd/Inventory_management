<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_slug' => 'required|string|max:255|unique:categories,cat_slug',
            'category_code' => 'nullable|string|max:100',
            'cat_description' => 'nullable|string',
        ]);

        Categories::create([
            'cat_name' => $request->cat_name,
            'cat_slug' => $request->cat_slug,
            'category_code' => 'CAT-' . strtoupper(uniqid()),
            'cat_description' => $request->cat_description,
        ]);

        return redirect()->route('backend.categories.index')->with('success', 'Category created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        return view('backend.categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        return view('backend.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_slug' => 'required|string|max:255|unique:categories,cat_slug,' . $categories->id,
            'category_code' => 'nullable|string|max:100',
            'cat_description' => 'nullable|string',
        ]);
        $categories->update([
            'cat_name' => $request->cat_name,
            'cat_slug' => $request->cat_slug,
            'category_code' => $request->category_code,
            'cat_description' => $request->cat_description,
        ]);

        return redirect()->route('backend.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        $categories->delete();
        return redirect()->route('backend.categories.index')->with('success', 'Category deleted successfully.');
    }
}
