@extends('backend.layouts.admin')

@section('title', 'Edit Unit')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Edit Unit</h1>
            <p class="text-gray-500 text-sm">Update unit details and status</p>
        </div>
        <a href="{{ route('backend.units.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition">
            ← Back to Units
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-200">
        <form action="{{ route('backend.units.update', $units->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Unit Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Unit Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $units->name) }}"
                        placeholder="Enter unit name (e.g., Kilograms)"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 bg-gray-50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none shadow-sm transition">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Short Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Short Name <span class="text-red-500">*</span></label>
                    <input type="text" name="short_name" id="short_name" value="{{ old('short_name', $units->short_name) }}"
                        placeholder="Enter short name (e.g., kg, pcs)"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 bg-gray-50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none shadow-sm transition">
                    @error('short_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No. of Products -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">No. of Products</label>
                    <input type="number" name="products_count" id="products_count"
                        value="{{ $unit->products_count ?? 0 }}" readonly
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-100 text-gray-500 shadow-sm cursor-not-allowed">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700 shadow-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none transition">
                        <option value="1" {{ old('status', $units->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $units->status) == 0 ? 'selected' : '' }}>Inactive</option>
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
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700 shadow-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none transition">{{ old('description', $units->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('backend.units.index') }}"
                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-md transition">
                    💾 Update Unit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
