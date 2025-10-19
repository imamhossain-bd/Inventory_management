@extends('backend.layouts.admin')

@section('title', 'Add Variant Attribute')

@section('content')
<div class="p-6 bg-white rounded-lg shadow border border-gray-200">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Add Variant Attribute</h2>
            <p class="text-gray-500 text-sm">Create a new variant and its values</p>
        </div>
        <a href="{{ route('backend.variants.index') }}"
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md flex items-center space-x-2">
            <i class="fas fa-arrow-left"></i> <span>Back to List</span>
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('backend.variants.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Selection -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Select Product <span class="text-red-500">*</span></label>
                <select name="product_id" id="product_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700
                        focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">
                    <option value="">-- Choose a Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Variant Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Variant Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="e.g., Color, Size, Material"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 bg-gray-50
                           focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700
                           focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description" rows="4"
                    placeholder="Write a short description..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700
                           focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Dynamic Variant Values -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center space-x-2">
                <i class="fas fa-list text-orange-500"></i>
                <span>Variant Values</span>
            </h3>

            <div id="valuesWrapper" class="space-y-3">
                <div class="flex items-center gap-3">
                    <input type="text" name="values[]" placeholder="Enter a value (e.g., Red, Large)"
                        class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700
                               focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">
                    <button type="button" onclick="addValueField()"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded-md">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('backend.variants.index') }}"
                class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition shadow-sm">
                Cancel
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-medium shadow-md transition">
                <i class="fas fa-save mr-1"></i> Save Variant
            </button>
        </div>
    </form>
</div>

<!-- JS: Dynamic Value Fields -->
<script>
    function addValueField() {
        const wrapper = document.getElementById('valuesWrapper');
        const field = document.createElement('div');
        field.classList.add('flex', 'items-center', 'gap-3');
        field.innerHTML = `
            <input type="text" name="values[]" placeholder="Enter a value (e.g., Blue, Medium)"
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700
                       focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">
            <button type="button" onclick="this.parentElement.remove()"
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md">
                <i class="fas fa-minus"></i>
            </button>
        `;
        wrapper.appendChild(field);
    }
</script>
@endsection
