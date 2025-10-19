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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.variants.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:255',
            'values' => 'required|array|min:1',
            'values.*' => 'string|max:255',
            'status' => 'boolean',
        ]);

            Variants::create([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'value' => $request->values,
                'status' => $request->status ?? 1,
            ]);

        return redirect()->route('backend.variants.index')->with('success', 'Variant(s) created successfully.');
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
    public function edit(Variants $variants)
    {
        $variants = Variants::findOrFail($variants->id);
        $products = Product::all();
        return view('backend.variants.edit', compact('variants', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Variants $variant)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'name' => 'required|string|max:255',
            'values' => 'required|array|min:1',
            'values.*' => 'string|max:255',
            'status' => 'boolean',
        ]);

        $variant->update([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'value' => $request->values,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('backend.variants.index')->with('success', 'Variant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variants $variants)
    {
        $variants->delete();
        return redirect()->route('backend.variants.index')->with('success', 'Variant deleted successfully.');
    }
}
