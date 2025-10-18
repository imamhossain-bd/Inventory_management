<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brands::latest()->paginate(10);
        return view('backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands,name',
            'slug' => 'required|unique:brands,slug',
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:1,0',
        ]);

        $brand = Brands::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
            $brand->logo = $logoPath;
        }

        $brand->save();

        return redirect()->route('backend.brands.index')->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brands $brands)
    {
        $brands = Brands::findOrFail($brands->id);
        return view('backend.brands.show', compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brands)
    {
        $brands = Brands::findOrFail($brands->id);
        return view('backend.brands.edit', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brands $brands)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,' . $brands->id,
            'slug' => 'required|unique:brands,slug,' . $brands->id,
            'logo' => 'nullable|image|max:2048',
            'status' => 'required|in:1,0',
        ]);

        $brands->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
            $brands->logo = $logoPath;
        }

        $brands->save();

        return redirect()->route('backend.brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brands)
    {
        $brands->delete();
        return redirect()->route('backend.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
