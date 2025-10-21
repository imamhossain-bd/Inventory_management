<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use App\Models\Units;
use App\Models\Variants;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        $brands = Brands::all();
        $units = Units::all();
        $variants = Variants::all();
        $warranties = Warranty::all();

        return view('backend.products.create', compact('categories', 'brands', 'units', 'variants', 'warranties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'sku' => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'barcode' => 'nullable|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'stock_alert' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'warranty_id' => 'nullable|exists:warranties,id',
            // 'warehouse_id' => 'nullable|exists:warehouses,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug ?? strtoupper(Str::random(8)),
            'sku' => $request->sku,
            'description' => $request->description,
            'barcode' => $request->barcode,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'stock_alert' => $request->stock_alert ?? 10,
            'status' => $request->status,
            'warranty_id' => $request->warranty_id,
            // 'warehouse_id' => $request->warehouse_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
        ]);

        // ---------------- Image Upload & thumbnail ----------------
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $product->thumbnail = $thumbnailPath;
            $product->save();
        }
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images', 'public');
                $imagePaths[] = $path;
            }
            $product->images = json_encode($imagePaths);
            $product->save();
        }

        return redirect()->route('backend.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::all();
        $brands = Brands::all();
        $units = Units::all();
        $warranties = Warranty::all();
        $variants = Variants::all();


        return view('backend.products.edit', compact('product', 'categories', 'brands', 'units',  'warranties', 'variants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'barcode' => 'nullable|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'stock_alert' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'warranty_id' => 'nullable|exists:warranties,id',
            // 'warehouse_id' => 'nullable|exists:warehouses,id',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'description' => $request->description,
            'barcode' => $request->barcode,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock,
            'stock_alert' => $request->stock_alert ?? 10,
            'status' => $request->status,
            'warranty_id' => $request->warranty_id,
            // 'warehouse_id' => $request->warehouse_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
        ]);

        // ---------------- Image Upload & thumbnail ----------------
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
            $product->thumbnail = $thumbnailPath;
            $product->save();
        }

        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images', 'public');
                $imagePaths[] = $path;
            }
            $product->images = json_encode($imagePaths);
            $product->save();
        }

        return redirect()->route('backend.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
