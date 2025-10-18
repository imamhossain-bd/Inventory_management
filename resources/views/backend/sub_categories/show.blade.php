@extends('backend.layouts.admin')

@section('title', 'View Sub Category Details')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Sub Category Details</h1>
            <p class="text-gray-500 text-sm">Full information about this sub category</p>
        </div>

        <a href="{{ route('backend.sub_categories.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-col md:flex-row md:items-start gap-6">
            <!-- Image -->
            <div class="w-full md:w-1/3">
                @if($subCategory->image)
                    <img src="{{ asset('storage/'.$subCategory->image) }}" alt="sub-category"
                         class="w-full rounded-xl object-cover shadow">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="no image"
                         class="w-full rounded-xl object-cover shadow">
                @endif
            </div>

            <!-- Info -->
            <div class="w-full md:w-2/3 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-sm text-gray-500">Sub Category Name</h2>
                        <p class="text-lg font-semibold text-gray-800">{{ $subCategory->name }}</p>
                    </div>

                    <div>
                        <h2 class="text-sm text-gray-500">Category</h2>
                        <p class="text-lg font-semibold text-gray-800">{{ $subCategory->category->cat_name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <h2 class="text-sm text-gray-500">Category Code</h2>
                        <p class="text-lg font-semibold text-gray-800">{{ $subCategory->category_code ?? '-' }}</p>
                    </div>

                    <div>
                        <h2 class="text-sm text-gray-500">Status</h2>
                        @if($subCategory->status == 1)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Inactive</span>
                        @endif
                    </div>
                </div>

                <div>
                    <h2 class="text-sm text-gray-500">Description</h2>
                    <p class="text-gray-700 mt-1 leading-relaxed">{{ $subCategory->description ?? 'No description provided.' }}</p>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <h2 class="text-sm text-gray-500">Created At</h2>
                    <p class="text-gray-800">{{ $subCategory->created_at->format('d M, Y h:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end mt-6 gap-3">
            <a href="{{ route('backend.sub_categories.edit', $subCategory->id) }}"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>

            <form action="{{ route('backend.sub_categories.destroy', $subCategory->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this sub-category?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
