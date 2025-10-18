<?php

namespace App\Http\Controllers;

use App\Models\Units;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Units::latest()->paginate(10);
        return view('backend.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'no_of_product' => 'nullable|integer',
            'status' => 'required|in:1,0',
        ]);

        Units::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'no_of_product' => $request->no_of_product,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('backend.units.index')->with('success', 'Unit created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Units $units)
    {
        $units = Units::findOrFail($units->id);
        return view('backend.units.show', compact('units'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Units $units)
    {
        $units = Units::findOrFail($units->id);
        return view('backend.units.edit', compact('units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Units $units)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'nullable|string|max:100',
            'no_of_product' => 'nullable|integer',
            'status' => 'required|in:1,0',
        ]);

        $units->update([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'no_of_product' => $request->no_of_product,
            'status' => $request->status,
        ]);

        return redirect()->route('backend.units.index')->with('success', 'Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Units $units)
    {
        $units->delete();
        return redirect()->route('backend.units.index')->with('success', 'Unit deleted successfully.');
    }
}
