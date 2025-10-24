<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variants;
use Illuminate\Http\Request;

class VariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = Variants::latest()->paginate(10);
        return view('backend.variants.index', compact('variants'));
    }


    public function create()
    {
        $products = Product::all();
        return view('backend.variants.create', compact('products'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:50',
            'values' => 'required|array|min:1',
            'values.*' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

        Variants::create([
            'name' => $request->name,
            'type' => $request->type,
            'value' => $request->values,
            'product_id' => $request->product_id,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('backend.variants.index')->with('success', 'Variant created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Variants $variants)
    {
        $variants = Variants::findOrFail($variants->id);
        return view('backend.variants.show', compact('variants'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variants $variant)
    {
        $variants = Variants::findOrFail($variant->id);
        $products = Product::all();
        return view('backend.variants.edit', compact('variants', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variants $variant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:50',
            'values' => 'required|array|min:1',
            'values.*' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

        $variant->update([
            'name' => $request->name,
            'type' => $request->type,
            'value' => $request->values,
            'product_id' => $request->product_id,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('backend.variants.index')->with('success', 'Variant updated successfully.');
    }


    public function destroy(Variants $variant)
    {
        $variant->delete();
        return redirect()->route('backend.variants.index')->with('success', 'Variant deleted successfully.');
    }
}
