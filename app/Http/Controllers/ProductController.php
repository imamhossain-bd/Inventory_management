<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use App\Models\SubCategories;
use App\Models\Units;
use App\Models\Variants;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Categories::all();
        $brands = Brands::all();
        $units = Units::all();
        $variants = Variants::all();
        $warranties = Warranty::all();
        $sub_categories = SubCategories::all();

        return view('backend.products.create', compact('categories', 'brands', 'units', 'variants', 'warranties', 'sub_categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:products,slug',
            'sku'              => 'required|string|max:100|unique:products,sku',
            'description'      => 'nullable|string',
            'barcode'          => 'nullable|string|max:100',
            'purchase_price'   => 'required|numeric|min:0',
            'selling_price'    => 'required|numeric|min:0',
            'discount_price'   => 'nullable|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'stock_alert'      => 'nullable|integer|min:0',
            'thumbnail'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'           => 'required|in:active,inactive',
            'warranty_id'      => 'nullable|exists:warranties,id',
            'category_id'      => 'required|exists:categories,id',
            'sub_category_id'  => 'nullable|exists:sub_categories,id',
            'brand_id'         => 'nullable|exists:brands,id',
            'unit_id'          => 'required|exists:units,id',
            'variants_id'      => 'nullable|exists:variants,id',
        ]);

        // ✅ Create Product
        $product = Product::create([
            'name'            => $request->name,
            'slug'            => $request->slug ?? Str::slug($request->name) . '-' . strtoupper(Str::random(4)),
            'sku'             => $request->sku,
            'barcode'         => $request->barcode,
            'purchase_price'  => $request->purchase_price,
            'selling_price'   => $request->selling_price,
            'discount_price'  => $request->discount_price,
            'stock'           => $request->stock,
            'stock_alert'     => $request->stock_alert ?? 10,
            'description'     => $request->description,
            'status'          => $request->status,
            'warranty_id'     => $request->warranty_id,
            'category_id'     => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id'        => $request->brand_id,
            'unit_id'         => $request->unit_id,
            'variants_id'     => $request->variants_id,
            'duration'        => $request->duration,
            'manufacturer'    => $request->manufacturer,
            'manufacturer_date' => $request->manufacturer_date,
            'expire_date'     => $request->expire_date,
        ]);

        // ✅ Thumbnail upload
        // if ($request->hasFile('thumbnail')) {
        //     $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
        //     $product->update(['thumbnail' => $thumbnailPath]);
        // }

        // ✅ Multiple images upload
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images', 'public');
                $imagePaths[] = $path;
            }
            $product->update(['images' => json_encode($imagePaths)]);
        }

        return redirect()->route('backend.products.index')->with('success', '✅ Product created successfully.');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::all();
        $brands = Brands::all();
        $units = Units::all();
        $variants = Variants::all();
        $warranties = Warranty::all();
        $sub_categories = SubCategories::all();

        return view('backend.products.edit', compact('product', 'categories', 'brands', 'units', 'variants', 'warranties', 'sub_categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'sku'              => 'required|string|max:100|unique:products,sku,' . $product->id,
            'description'      => 'nullable|string',
            'barcode'          => 'nullable|string|max:100',
            'purchase_price'   => 'required|numeric|min:0',
            'selling_price'    => 'required|numeric|min:0',
            'discount_price'   => 'nullable|numeric|min:0',
            'stock'            => 'required|integer|min:0',
            'stock_alert'      => 'nullable|integer|min:0',
            'thumbnail'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'           => 'nullable|array',
            'images.*'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'           => 'required|in:active,inactive',
            'warranty_id'      => 'nullable|exists:warranties,id',
            'category_id'      => 'required|exists:categories,id',
            'sub_category_id'  => 'nullable|exists:sub_categories,id',
            'brand_id'         => 'nullable|exists:brands,id',
            'unit_id'          => 'required|exists:units,id',
            'variants_id'      => 'nullable|exists:variants,id',
        ]);

        $product->update([
            'name'            => $request->name,
            'slug'            => $request->slug ?? Str::slug($request->name),
            'sku'             => $request->sku,
            'barcode'         => $request->barcode,
            'purchase_price'  => $request->purchase_price,
            'selling_price'   => $request->selling_price,
            'discount_price'  => $request->discount_price,
            'stock'           => $request->stock,
            'stock_alert'     => $request->stock_alert ?? 10,
            'description'     => $request->description,
            'status'          => $request->status,
            'warranty_id'     => $request->warranty_id,
            'category_id'     => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id'        => $request->brand_id,
            'unit_id'         => $request->unit_id,
            'variants_id'     => $request->variants_id,
            'duration'        => $request->duration,
            'manufacturer'    => $request->manufacturer,
            'manufacturer_date' => $request->manufacturer_date,
            'expire_date'     => $request->expire_date,
        ]);

        // ✅ Replace thumbnail if uploaded
        // if ($request->hasFile('thumbnail')) {
        //     if ($product->thumbnail) {
        //         Storage::disk('public')->delete($product->thumbnail);
        //     }
        //     $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
        //     $product->update(['thumbnail' => $thumbnailPath]);
        // }

        // ✅ Replace images if uploaded
        if ($request->hasFile('images')) {
            if ($product->images) {
                foreach (json_decode($product->images, true) as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products/images', 'public');
                $imagePaths[] = $path;
            }
            $product->update(['images' => json_encode($imagePaths)]);
        }

        return redirect()->route('backend.products.index')->with('success', '✅ Product updated successfully.');
    }

    /**
     * Remove a product.
     */
    public function destroy(Product $product)
    {
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        if ($product->images) {
            foreach (json_decode($product->images, true) as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $product->delete();

        return redirect()->route('backend.products.index')
            ->with('success', '🗑️ Product deleted successfully.');
    }
}
