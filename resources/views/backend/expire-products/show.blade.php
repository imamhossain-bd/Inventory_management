@extends('backend.layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow max-w-3xl mx-auto">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Expired Product Details</h1>

    <div class="flex items-center gap-4 mb-6">
        <img src="{{ asset($product->image ?? 'assets/images/no-image.png') }}" alt="" class="w-24 h-24 rounded object-cover">
        <div>
            <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
            <p class="text-gray-600">SKU: {{ $product->sku }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4 text-gray-700">
        <div>
            <p class="font-medium">Manufactured Date:</p>
            <p>{{ \Carbon\Carbon::parse($product->manufactured_date)->format('d M Y') }}</p>
        </div>
        <div>
            <p class="font-medium">Expired Date:</p>
            <p>{{ \Carbon\Carbon::parse($product->expired_date)->format('d M Y') }}</p>
        </div>
        <div>
            <p class="font-medium">Category:</p>
            <p>{{ $product->category->name ?? 'N/A' }}</p>
        </div>
        <div>
            <p class="font-medium">Stock:</p>
            <p>{{ $product->stock ?? '0' }}</p>
        </div>
    </div>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('backend.expire-products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <a href="{{ route('backend.expire-products.edit', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>
</div>
@endsection
