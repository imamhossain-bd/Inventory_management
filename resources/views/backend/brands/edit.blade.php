@extends('backend.layouts.admin')

@section('title', 'Edit Brand')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Edit Brand</h1>
            <p class="text-gray-500 text-sm">Update brand details</p>
        </div>
        <a href="{{ route('backend.brands.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition">
            ← Back to Brands
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-lg rounded-xl p-8 border border-gray-200">
        <form action="{{ route('backend.brands.update', $brands->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Brand Name -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium mb-2">Brand Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $brands->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none transition"
                        placeholder="Enter brand name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-gray-700 font-medium mb-2">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $brands->slug) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none transition"
                        placeholder="auto-generated">
                    @error('slug')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo -->
                <div>
                    <label for="logo" class="block text-gray-700 font-medium mb-2">Brand Logo</label>
                    <input type="file" name="logo" id="logo" accept="image/*" onchange="previewLogo(event)"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-white text-gray-800 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none transition">

                    <div class="mt-3">
                        <img id="logoPreview"
                             src="{{ $brands->logo ? asset('storage/'.$brands->logo) : asset('images/no-image.png') }}"
                             alt="Brand Logo"
                             class="w-24 h-24 rounded-lg border border-gray-300 object-cover bg-gray-100 shadow-sm">
                    </div>
                    @error('logo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-gray-700 font-medium mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none transition">
                        <option value="1" {{ old('status', $brands->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $brands->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-gray-800 bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none transition"
                        placeholder="Write a short description...">{{ old('description', $brands->description) }}</textarea>
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
                    💾 Update Brand
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
    // Logo Preview
    function previewLogo(event) {
        const reader = new FileReader();
        reader.onload = () => {
            document.getElementById('logoPreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Auto Slug
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/\s+/g, '-');
        document.getElementById('slug').value = slug;
    });
</script>
@endsection
