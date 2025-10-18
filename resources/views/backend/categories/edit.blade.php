@extends('backend.layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Category</h1>
            <p class="text-gray-500 mt-1 text-sm">Update category details and keep your data organized.</p>
        </div>
        <a href="{{ route('backend.categories.index') }}"
           class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm transition">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Categories
        </a>
    </div>

    {{-- Edit Form Card --}}
    <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-100">
        <form action="{{ route('backend.categories.update', $categories->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Category Info Section --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Category Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Category Name --}}
                    <div>
                        <label for="cat_name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-tag mr-1 text-blue-500"></i> Category Name
                        </label>
                        <input type="text" name="cat_name" id="cat_name" value="{{ $categories->cat_name }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            placeholder="Enter category name" required>
                    </div>

                    {{-- Category Slug --}}
                    <div>
                        <label for="cat_slug" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-link mr-1 text-blue-500"></i> Category Slug
                        </label>
                        <input type="text" name="cat_slug" id="cat_slug" value="{{ $categories->cat_slug }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            placeholder="auto-generated slug" required>
                    </div>
                </div>
            </div>

            {{-- Code & Description --}}
            <div>
                <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Code & Description</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Category Code --}}
                    <div>
                        <label for="category_code" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-barcode mr-1 text-blue-500"></i> Category Code
                        </label>
                        <input type="text" name="category_code" id="category_code" value="{{ $categories->category_code }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                            readonly>
                    </div>

                    {{-- Created Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fa-solid fa-calendar-days mr-1 text-blue-500"></i> Created At
                        </label>
                        <input type="text"
                            value="{{ $categories->created_at ? $categories->created_at->format('M d, Y') : '—' }}"
                            class="w-full border border-gray-200 bg-gray-100 rounded-lg px-4 py-2 text-gray-600"
                            readonly>
                    </div>
                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <label for="cat_description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fa-solid fa-align-left mr-1 text-blue-500"></i> Category Description
                    </label>
                    <textarea name="cat_description" id="cat_description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition"
                        placeholder="Write a short description...">{{ $categories->cat_description }}</textarea>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end items-center gap-4 pt-6 border-t">
                <a href="{{ route('backend.categories.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium shadow-md transition">
                    <i class="fa-solid fa-rotate mr-1"></i> Update Category
                </button>
            </div>
        </form>
    </div>
</div>

{{-- JS Section --}}
<script>
    // Auto-generate slug from category name
    document.getElementById('cat_name').addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('cat_slug').value = slug;
    });

    // Auto-generate random code (only if empty)
    function generateCategoryCode(length = 5) {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let code = '';
        for (let i = 0; i < length; i++) {
            code += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return code;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const codeInput = document.getElementById('category_code');
        if (!codeInput.value) {
            codeInput.value = generateCategoryCode();
        }
    });
</script>
@endsection
