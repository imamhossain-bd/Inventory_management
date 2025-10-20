@extends('backend.layouts.admin')

@section('title', 'Create Warranty')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-8 border-2 border-[#dfdfdf]">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Create Warranty</h2>
            <p class="text-gray-500 text-sm">Add a new warranty option for your products.</p>
        </div>
        <a href="{{ route('backend.warranties.index') }}"
           class="inline-flex items-center text-sm text-gray-600 hover:text-gray-800 bg-gray-100 px-4 py-2.5 rounded-lg border border-gray-200">
            <i class="fas fa-arrow-left mr-2"></i> Back to Warranties
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('backend.warranties.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Row 1 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Select Product (optional)
                </label>
                <select id="product_id" name="product_id"
                    class="w-full text-base border border-gray-300 rounded-lg bg-gray-50 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Warranty Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name"
                    class="w-full text-base border border-gray-300 rounded-lg bg-gray-50 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                    placeholder="Enter warranty name" required>
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                    Slug <span class="text-red-500">*</span>
                </label>
                <input type="text" id="slug" name="slug"
                    class="w-full text-base border border-gray-200 rounded-lg bg-gray-100 px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none"
                    placeholder="auto-generated" readonly>
            </div>

            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                    Duration <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-3">
                    <input type="number" id="duration" name="duration"
                        class="w-1/2 text-base border border-gray-300 rounded-lg bg-gray-50 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="0" min="0" required>
                    <select id="duration_type" name="duration_type"
                        class="w-1/2 text-base border border-gray-300 rounded-lg bg-gray-50 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" required>
                        <option value="days">Days</option>
                        <option value="months">Months</option>
                        <option value="years">Years</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Description
            </label>
            <textarea id="description" name="description" rows="4"
                class="w-full text-base border border-gray-300 rounded-lg bg-gray-50 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-none"
                placeholder="Write a short description..."></textarea>
        </div>

        {{-- Status --}}
        <div class="flex items-center space-x-2">
            <input type="checkbox" id="status" name="status" value="1"
                class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" checked>
            <label for="status" class="text-sm text-gray-700">Active</label>
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end space-x-3 pt-4">
            <a href="{{ route('backend.warranties.index') }}"
               class="px-5 py-3 text-sm font-medium rounded-lg bg-gray-100 text-gray-800 border border-gray-200 hover:bg-gray-200">
               Cancel
            </a>
            <button type="submit"
                    class="px-6 py-3 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition">
                <i class="fas fa-plus mr-2"></i> Create Warranty
            </button>
        </div>
    </form>
</div>

{{-- Auto Slug Generator --}}
<script>
    document.getElementById('name').addEventListener('input', function () {
        let slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
