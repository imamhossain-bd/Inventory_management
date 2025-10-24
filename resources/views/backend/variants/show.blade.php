@extends('backend.layouts.admin')

@section('title', 'Variant Details')

@section('content')
<div class="p-8 bg-white rounded-lg shadow border border-gray-200">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Variant Details</h2>
            <p class="text-gray-500 text-sm">Detailed information about this variant</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('backend.variants.index') }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i> <span>Back</span>
            </a>
            <a href="{{ route('backend.variants.edit', $variant->id) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-edit"></i> <span>Edit</span>
            </a>
        </div>
    </div>

    <!-- Variant Info Card -->
    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-4">
            {{-- <div>
                <h3 class="text-gray-600 font-semibold">Product</h3>
                <p class="text-gray-800 font-medium">{{ $variant->product->name ?? 'N/A' }}</p>
            </div> --}}
            <div>
                <h3 class="text-gray-600 font-semibold">Variant Name</h3>
                <p class="text-gray-800 font-medium">{{ $variant->name }}</p>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold">Status</h3>
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                    {{ $variant->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $variant->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <h3 class="text-gray-600 font-semibold">Created At</h3>
                <p class="text-gray-800">{{ $variant->created_at->format('d M, Y h:i A') }}</p>
            </div>
            <div>
                <h3 class="text-gray-600 font-semibold">Updated At</h3>
                <p class="text-gray-800">{{ $variant->updated_at->format('d M, Y h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <hr class="my-8">

    <!-- Variant Values -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center space-x-2">
            <i class="fas fa-list text-orange-500"></i>
            <span>Variant Values</span>
        </h3>
        @if(!empty($variant->value) && is_array($variant->value))
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <ul class="list-disc pl-6 space-y-1 text-gray-700">
                    @foreach($variant->value as $val)
                        <li>{{ $val }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="text-gray-500 italic">No values found for this variant.</p>
        @endif
    </div>

    <!-- Description -->
    @if(!empty($variant->description))
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center space-x-2">
                <i class="fas fa-align-left text-orange-500"></i>
                <span>Description</span>
            </h3>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-gray-700 leading-relaxed">
                {{ $variant->description }}
            </div>
        </div>
    @endif

    <!-- Footer -->
    <div class="mt-8 flex justify-end">
        <a href="{{ route('backend.variants.index') }}"
            class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>
</div>
@endsection
