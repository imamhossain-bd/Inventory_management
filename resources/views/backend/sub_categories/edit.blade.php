@extends('backend.layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Sub Category</h1>
            <p class="text-gray-500">Update existing sub category details.</p>
        </div>
        <a href="{{ route('backend.sub_categories.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">
            ← Back to Sub Categories
        </a>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('backend.sub_categories.update', $subCategories->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Category & Name --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Parent Category
                    </label>
                    <select name="category_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $subCategories->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->cat_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Sub Category Name
                    </label>
                    <input type="text" name="name" value="{{ $subCategories->name }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
            </div>

            {{-- Slug & Image --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Slug
                    </label>
                    <input type="text" name="slug" value="{{ $subCategories->slug }}" class="w-full border rounded-lg px-3 py-2 bg-gray-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Current Image
                    </label>
                    @if ($subCategories->image)
                        <img src="{{ asset('storage/' . $subCategories->image) }}" alt="" class="w-24 h-24 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="image" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                </div>
            </div>

            {{-- Description & Status --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">{{ $subCategories->description }}</textarea>
            </div>

            <div class="flex items-center mb-6">
                <input type="checkbox" name="status" value="1" {{ $subCategories->status ? 'checked' : '' }} class="mr-2">
                <label class="text-sm text-gray-700">Active</label>
            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('backend.sub_categories.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                    Update Sub Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
