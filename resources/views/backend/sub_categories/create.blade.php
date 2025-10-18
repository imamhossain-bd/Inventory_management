@extends('backend.layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Create Sub Category</h1>
            <p class="text-gray-500">Add a new sub category under an existing category.</p>
        </div>
        <a href="{{ route('backend.sub_categories.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">
            ← Back to Sub Categories
        </a>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('backend.sub_categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Parent Category & Sub Category Name --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Parent Category --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Parent Category <span class="text-red-500">*</span>
                    </label>
                    <select id="category_id" name="category_id"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-code="{{ $category->category_code }}">
                                {{ $category->cat_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sub Category Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sub Category Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                        placeholder="Enter sub category name" required>
                </div>
            </div>

            {{-- Slug & Image --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                {{-- Slug --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sub Category Slug
                    </label>
                    <input type="text" name="slug" id="slug" class="w-full border rounded-lg px-3 py-2 bg-gray-100" placeholder="auto-generated" readonly>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sub Category Image
                    </label>
                    <input type="file" name="image" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
            </div>

            {{-- Category Code --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Category Code
                </label>
                <input type="text" name="category_code" id="category_code" class="w-full border rounded-lg px-3 py-2 bg-gray-100" placeholder="auto-filled based on selected category" readonly>
            </div>

            {{-- Description --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description" rows="4"
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300"
                    placeholder="Write a short description..."></textarea>
            </div>

            {{-- Status --}}
            <div class="flex items-center mb-6">
                <input type="checkbox" name="status" value="1" checked class="mr-2">
                <label class="text-sm text-gray-700">Active</label>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('backend.sub_categories.index') }}"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    + Create Sub Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const categorySelect = document.getElementById('category_id');
    const categoryCodeInput = document.getElementById('category_code');

    // ✅ Auto-generate slug when typing name
    document.getElementById('name').addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    });

    // ✅ Auto-fill category code when selecting category
    categorySelect.addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let code = selectedOption.getAttribute('data-code');
        categoryCodeInput.value = code ? code : '';
    });
});
</script>
@endpush
