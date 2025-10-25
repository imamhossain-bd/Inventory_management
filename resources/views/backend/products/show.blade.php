@extends('backend.layouts.admin')

@section('title', 'Product Details')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
    {{-- ======= Header / Company Info ======= --}}
    <div class="text-center border-b pb-6 mb-6">
        <h1 class="text-3xl font-bold text-gray-800 uppercase tracking-wide">Inventory System</h1>
        <p class="text-gray-500">123 Business Road, Dhaka, Bangladesh</p>
        <p class="text-gray-500">Email: info@inventory.com | Phone: +880 1234 567 890</p>
        <h2 class="text-xl font-semibold text-blue-700 mt-4">Product Details Invoice</h2>
    </div>

    {{-- ======= Product Header Section ======= --}}
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
        <div class="space-y-1">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
            <p class="text-gray-500">SKU: <span class="font-medium text-gray-700">{{ $product->sku }}</span></p>
            <p class="text-gray-500">Barcode: <span class="font-medium text-gray-700">{{ $product->barcode ?? 'N/A' }}</span></p>
            <p class="text-gray-500">Status:
                <span class="px-3 py-1 rounded-full text-sm
                    {{ $product->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </p>
        </div>

        {{-- Product Image --}}
        <div class="mt-4 md:mt-0">
            @if($product->images && count(json_decode($product->images)) > 0)
                <img src="{{ asset('storage/' . json_decode($product->images)[0]) }}"
                     alt="Product Image"
                     class="w-48 h-48 object-cover rounded-lg border shadow">
            @else
                <div class="w-48 h-48 bg-gray-100 flex items-center justify-center rounded-lg border">
                    <span class="text-gray-400">No Image</span>
                </div>
            @endif
        </div>
    </div>

    {{-- ======= Product Basic Info ======= --}}
    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Basic Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div><p class="font-medium text-gray-600">Slug:</p><p class="text-gray-800">{{ $product->slug }}</p></div>
        <div><p class="font-medium text-gray-600">Category:</p><p class="text-gray-800">{{ $product->categories->cat_name ?? 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Sub Category:</p><p class="text-gray-800">{{ $product->subCategory->name ?? 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Brand:</p><p class="text-gray-800">{{ $product->brand->name ?? 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Unit:</p><p class="text-gray-800">{{ $product->unit->short_name ?? 'N/A' }}</p></div>
        <div>
            <p class="font-medium text-gray-600">Variant:</p><p>{{ $product->variants_id ?? 'N/A' }}</p>
        </div>

    </div>

    {{-- ======= Pricing Info ======= --}}
    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">Pricing Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div><p class="font-medium text-gray-600">Purchase Price:</p><p class="text-gray-800">${{ number_format($product->purchase_price, 2) }}</p></div>
        <div><p class="font-medium text-gray-600">Selling Price:</p><p class="text-gray-800">${{ number_format($product->selling_price, 2) }}</p></div>
        <div><p class="font-medium text-gray-600">Discount Price:</p><p class="text-gray-800">${{ number_format($product->discount_price, 2) }}</p></div>
        <div><p class="font-medium text-gray-600">Tax Type:</p><p class="text-gray-800">{{ ucfirst($product->tax_type ?? 'N/A') }}</p></div>
        <div><p class="font-medium text-gray-600">Tax Amount:</p><p class="text-gray-800">{{ $product->tax_amount ? $product->tax_amount . '%' : 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Total Amount:</p><p class="text-gray-800 font-semibold">${{ number_format($product->total_amount, 2) }}</p></div>
    </div>

    {{-- ======= Stock Info ======= --}}
    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">Stock Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div><p class="font-medium text-gray-600">Stock Quantity:</p><p class="text-gray-800">{{ $product->stock }}</p></div>
        <div><p class="font-medium text-gray-600">Stock Alert:</p><p class="text-gray-800">{{ $product->stock_alert }}</p></div>
        <div><p class="font-medium text-gray-600">Warranty:</p><p class="text-gray-800">{{ $product->warranty->name ?? 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Warranty Duration:</p>
            <p class="text-gray-800">{{ $product->duration ?? ($product->warranty->duration ?? 'N/A') }}</p>
        </div>
    </div>

    {{-- ======= Manufacturer Info ======= --}}
    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">Manufacturer Details</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div><p class="font-medium text-gray-600">Manufacturer:</p><p class="text-gray-800">{{ $product->manufacturer ?? 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Manufacture Date:</p><p class="text-gray-800">{{ $product->manufacturer_date ?? 'N/A' }}</p></div>
        <div><p class="font-medium text-gray-600">Expire Date:</p><p class="text-gray-800">{{ $product->expire_date ?? 'N/A' }}</p></div>
    </div>

    {{-- ======= Description ======= --}}
    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">Description</h3>
    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $product->description ?? 'No description available.' }}</p>

    {{-- ======= Gallery ======= --}}
    @if($product->images && count(json_decode($product->images)) > 1)
        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">Image Gallery</h3>
        <div class="flex flex-wrap gap-4">
            @foreach(json_decode($product->images) as $img)
                <img src="{{ asset('storage/' . $img) }}" alt="Image" class="w-28 h-28 object-cover rounded-lg border shadow-sm">
            @endforeach
        </div>
    @endif

    {{-- ======= Footer ======= --}}
    <div class="mt-12 text-center border-t pt-6">
        <p class="text-gray-500 text-sm">Thank you for using Inventory System.</p>
        <p class="text-gray-400 text-xs">Generated on {{ now()->format('F d, Y h:i A') }}</p>
    </div>
</div>
@endsection
