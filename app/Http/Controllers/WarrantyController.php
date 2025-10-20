<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Http\Request;

class WarrantyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warranties = Warranty::latest()->paginate(10);
        return view('backend.warranties.index', compact('warranties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.warranties.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:warranties,slug',
            'duration' => 'required|integer|min:0',
            'duration_type' => 'required|in:days,months,years',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        Warranty::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'duration' => $validated['duration'],
            'duration_type' => $validated['duration_type'],
            'description' => $validated['description'] ?? null,
            'status' => $request->has('status') ? 1 : 0,
        ]);

        return redirect()->route('backend.warranties.index')->with('success', 'Warranty created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Warranty $warranty)
    {
        return view('backend.warranties.show', compact('warranty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $warranty = Warranty::findOrFail($id);
        $products = Product::all();
        return view('backend.warranties.edit', compact('warranty', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warranty $warranty)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:warranties,slug,' . $warranty->id,
            'duration' => 'required|integer|min:0',
            'duration_type' => 'required|in:days,months,years',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $warranty->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'duration' => $validated['duration'],
            'duration_type' => $validated['duration_type'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('backend.warranties.index')->with('success', 'Warranty updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warranty $warranty)
    {
        $warranty->delete();

        return redirect()->route('backend.warranties.index')->with('success', 'Warranty deleted successfully.');
    }
}
