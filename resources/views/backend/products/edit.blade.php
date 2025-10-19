@extends('backend.layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Product</h2>

    <form action="{{ route('backend.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Product Basic Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Product Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Slug <span class="text-red-500">*</span></label>
                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">
                @error('slug') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- SKU --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">SKU <span class="text-red-500">*</span></label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">
                @error('sku') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Barcode --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Barcode</label>
                <input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">
                @error('barcode') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" rows="4"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 focus:border-blue-400">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Pricing --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Purchase Price ($)</label>
                <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('purchase_price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Selling Price ($)</label>
                <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('selling_price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Discount Price ($)</label>
                <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('discount_price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Stock --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Stock Quantity</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Stock Alert</label>
                <input type="number" name="stock_alert" value="{{ old('stock_alert', $product->stock_alert) }}"
                    class="w-full border border-gray-300 rounded-lg p-2">
                @error('stock_alert') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Dropdowns --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Warehouse --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Warehouse</label>
                <select name="warehouse_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Warehouse</option>
                    {{-- @foreach($warehouses as $warehouse)
                        <option value="{{ $warehouse->id }}" {{ old('warehouse_id', $product->warehouse_id) == $warehouse->id ? 'selected' : '' }}>
                            {{ $warehouse->name }}
                        </option>
                    @endforeach --}}
                </select>
                @error('warehouse_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Category</label>
                <select name="category_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->cat_name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Brand --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Brand</label>
                <select name="brand_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Supplier --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Supplier</label>
                <select name="supplier_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Supplier</option>
                    {{-- @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach --}}
                </select>
                @error('supplier_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Unit --}}
            <div>
                <label class="block text-gray-700 font-medium mb-2">Unit</label>
                <select name="unit_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Unit</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
                @error('unit_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Status & Variant --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Variants</label>
                <select name="variants_id" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select Variant</option>
                    @foreach($variants as $variant)
                        <option value="{{ $variant->id }}" {{ old('variants_id', $product->variants_id) == $variant->id ? 'selected' : '' }}>
                            {{ implode(', ', $variant->value ?? []) }}
                        </option>
                    @endforeach
                </select>
                @error('variants_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Thumbnail & Gallery --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Thumbnail</label>
                @if($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Thumbnail" class="w-24 h-24 object-cover rounded mb-2">
                @endif
                <input type="file" name="thumbnail" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50">
                @error('thumbnail') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-2">Gallery Images</label>
                <input type="file" name="images[]" multiple class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50">
                @error('images.*') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-lg">
                Update Product
            </button>
        </div>
    </form>
</div>
@endsection
