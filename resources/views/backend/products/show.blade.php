@extends('backend.layouts.admin')

@section('title', 'Product Details')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Product Details</h2>

    {{-- Product Info --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Basic Information --}}
        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Basic Information</h3>
            <p><span class="font-semibold text-gray-700">Name:</span> {{ $product->name }}</p>
            <p><span class="font-semibold text-gray-700">Slug:</span> {{ $product->slug }}</p>
            <p><span class="font-semibold text-gray-700">SKU:</span> {{ $product->sku }}</p>
            <p><span class="font-semibold text-gray-700">Barcode:</span> {{ $product->barcode ?? 'N/A' }}</p>
            <p><span class="font-semibold text-gray-700">Status:</span>
                <span class="{{ $product->status === 'active' ? 'text-green-600' : 'text-red-600' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </p>
            <p><span class="font-semibold text-gray-700">Description:</span> {{ $product->description ?? 'N/A' }}</p>
        </div>

        {{-- Pricing and Stock --}}
        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Pricing & Stock</h3>
            <p><span class="font-semibold text-gray-700">Purchase Price:</span> ${{ number_format($product->purchase_price, 2) }}</p>
            <p><span class="font-semibold text-gray-700">Selling Price:</span> ${{ number_format($product->selling_price, 2) }}</p>
            <p><span class="font-semibold text-gray-700">Discount Price:</span>
                {{ $product->discount_price ? '$'.number_format($product->discount_price, 2) : 'N/A' }}
            </p>
            <p><span class="font-semibold text-gray-700">Stock:</span> {{ $product->stock }}</p>
            <p><span class="font-semibold text-gray-700">Stock Alert:</span> {{ $product->stock_alert ?? 10 }}</p>
        </div>
    </div>

    {{-- Related Data --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Warehouse</h3>
            <p>{{ $product->warehouse->name ?? 'N/A' }}</p>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Category</h3>
            <p>{{ $product->category->name ?? 'N/A' }}</p>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Brand</h3>
            <p>{{ $product->brand->name ?? 'N/A' }}</p>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Supplier</h3>
            <p>{{ $product->supplier->name ?? 'N/A' }}</p>
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Unit</h3>
            <p>{{ $product->unit->name ?? 'N/A' }}</p>
        </div>
    </div>

    {{-- Images --}}
    <div class="mt-10">
        <h3 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Product Images</h3>

        {{-- Thumbnail --}}
        <div class="mb-6">
            <p class="font-semibold text-gray-700 mb-2">Thumbnail:</p>
            @if ($product->thumbnail)
                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                    alt="Thumbnail" class="w-40 h-40 object-cover rounded-md border">
            @else
                <p class="text-gray-500">No thumbnail available.</p>
            @endif
        </div>

        {{-- Gallery Images --}}
        <div>
            <p class="font-semibold text-gray-700 mb-2">Gallery Images:</p>
            @if ($product->images && $product->images->count() > 0)
                <div class="flex flex-wrap gap-4">
                    @foreach ($product->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            alt="Product Image" class="w-32 h-32 object-cover rounded-md border">
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No gallery images available.</p>
            @endif
        </div>
    </div>

    {{-- Back Button --}}
    <div class="mt-8 flex justify-end">
        <a href="{{ route('inventory.products.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg transition">
           ← Back to Products
        </a>
    </div>
</div>
@endsection
