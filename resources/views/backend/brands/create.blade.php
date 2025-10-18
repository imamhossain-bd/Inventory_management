@extends('backend.layouts.admin')

@section('title', 'Create Brand')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Create Brand</h1>
            <p class="text-gray-500 text-sm">Add a new brand to your store</p>
        </div>
        <a href="{{ route('backend.brands.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition">
            ← Back to Brands
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-md rounded-xl p-8 border border-gray-200">
        <form action="{{ route('backend.brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Brand Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Brand Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="Enter brand name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 bg-gray-50 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none shadow-sm transition">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        placeholder="auto-generated"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-700 bg-gray-100 focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none shadow-sm transition">
                    @error('slug')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Brand Logo -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Brand Logo</label>
                    <input type="file" name="logo" id="logo"
                        accept="image/*" onchange="previewLogo(event)"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700 shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none transition">
                    <div class="mt-3">
                        <img id="logoPreview" src="{{ asset('images/no-image.png') }}"
                            class="w-20 h-20 object-cover rounded-md border border-gray-300 shadow-sm bg-gray-100">
                    </div>
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700">
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
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700 shadow-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-200 focus:outline-none transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('backend.brands.index') }}"
                    class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition shadow-sm">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium shadow-md transition">
                    + Create Brand
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS for live logo preview + auto slug -->
<script>
    // Image preview
    function previewLogo(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('logoPreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function () {
        const name = this.value;
        const slug = name
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
