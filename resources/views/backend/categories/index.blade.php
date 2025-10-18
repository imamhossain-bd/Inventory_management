@extends('backend.layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Category</h1>
            <p class="text-gray-500 text-sm">Manage your categories</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Export Buttons -->
            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm flex items-center gap-1">
                <i class="fa-solid fa-file-pdf"></i> PDF
            </button>
            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm flex items-center gap-1">
                <i class="fa-solid fa-file-excel"></i> XLS
            </button>
            <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-2 rounded-lg text-sm flex items-center gap-1">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
            <a href="{{ route('backend.categories.create') }}" id="openAddCategoryModal" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <!-- Search and Status Filter -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center gap-3">
                <input type="text" placeholder="Search" class="border border-gray-300 rounded-lg px-3 py-2 w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div>
                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option>Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
        </div>

        <!-- Category Table -->
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-sm text-gray-700">
                    <th class="py-3 px-4 w-12">
                        <input type="checkbox" class="rounded border-gray-400">
                    </th>
                    <th class="py-3 px-4">Category</th>
                    <th class="py-3 px-4">Category Slug</th>
                    <th class="py-3 px-4">Created On</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($categories as $category)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-4">
                        <input type="checkbox" class="rounded border-gray-400">
                    </td>
                    <td class="py-3 px-4 font-medium">{{ $category->cat_name }}</td>
                    <td class="py-3 px-4 text-gray-500">{{ $category->cat_slug }}</td>
                    <td class="py-3 px-4">{{ $category->created_at->format('d M Y') }}</td>
                    <td class="py-3 px-4">
                        <span class="bg-green-100 text-green-700 px-2 py-1 text-xs rounded">Active</span>
                    </td>
                    <td class="py-3 px-4 text-center space-x-2">
                        {{-- Show Category --}}
                        <a href="{{ route('backend.categories.show', $category->id) }}" class="text-gray-600 hover:text-gray-800">
                            <i class="fa-solid fa-eye text-gray-600 hover:text-gray-800"></i>
                        </a>

                        <a href="{{ route('backend.categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('backend.categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this category?')" class="text-red-600 hover:text-red-800">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($categories->isEmpty())
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">No categories found.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination + Row per page -->
        <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
            <div class="flex items-center gap-2">
                <span>Row per page</span>
                <select class="border border-gray-300 rounded px-2 py-1 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                <span>Entries</span>
            </div>
            <div class="flex items-center gap-3">
                <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-chevron-left"></i></button>
                <span>1</span>
                <button class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <!-- Floating Setting Button -->
    <button class="fixed bottom-8 right-8 bg-orange-500 text-white p-4 rounded-full shadow-lg hover:bg-orange-600">
        <i class="fa-solid fa-gear"></i>
    </button>
</div>
@endsection
