@extends('backend.layouts.admin')

@section('title', 'Create Category')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-gray-800">Create Category</h1>
            <p class="text-gray-500 text-sm">Add a new category and keep your data organized.</p>
        </div>
        <div>
            <a href="{{ route('backend.categories.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Back to Categories
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-md rounded-2xl p-8">
        <form action="{{ route('backend.categories.store') }}" method="POST">
            @csrf

            <!-- Category Information -->
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Category Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="cat_name" class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-tag text-blue-600"></i> Category Name
                    </label>
                    <input type="text" name="cat_name" id="cat_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Enter category name" required>
                </div>

                <div>
                    <label for="cat_slug" class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-link text-blue-600"></i> Category Slug
                    </label>
                    <input type="text" name="cat_slug" id="cat_slug" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="auto-generated" required>
                </div>
            </div>

            <!-- Code & Description -->
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Code & Description</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="cat_code" class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-barcode text-blue-600"></i> Category Code
                    </label>
                    <input type="text" name="cat_code" id="cat_code" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed focus:ring-0 focus:outline-none" readonly>
                </div>

                <div>
                    <label for="created_at" class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days text-blue-600"></i> Created At
                    </label>
                    <input type="text" id="created_at" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed focus:ring-0 focus:outline-none" value="{{ now()->format('M d, Y') }}" readonly>
                </div>
            </div>

            <div class="mb-6">
                <label for="cat_description" class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-align-left text-blue-600"></i> Category Description
                </label>
                <textarea name="cat_description" id="cat_description" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Write a short description..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('backend.categories.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Create Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto slug generate
    document.getElementById('cat_name').addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('cat_slug').value = slug;
    });

    // Auto category code generate
    function generateCategoryCode() {
        const randomPart = Math.random().toString(36).substring(2, 10).toUpperCase();
        return 'CAT-' + randomPart;
    }

    // Set code on page load
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('cat_code').value = generateCategoryCode();
    });
</script>
@endsection
