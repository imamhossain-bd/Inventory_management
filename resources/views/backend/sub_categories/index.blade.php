@extends('backend.layouts.admin')

@section('title', 'Sub Category List')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Sub Category</h1>
            <p class="text-gray-500 text-sm">Manage your sub categories</p>
        </div>

        <div class="flex items-center gap-3">
            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm">
                <i class="fa-solid fa-file-pdf mr-1"></i> PDF
            </button>
            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm">
                <i class="fa-solid fa-file-excel mr-1"></i> XLS
            </button>
            <a href="{{ route('backend.sub_categories.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Add Sub Category
            </a>
        </div>
    </div>

    <!-- Search + Filters -->
    <div class="bg-white rounded-xl shadow-md p-5 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative w-full md:w-1/3">
                <input type="text" id="search" placeholder="Search..."
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
            </div>

            <div class="flex items-center gap-3">
                <select id="filterCategory"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option value="">Category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->cat_name ?? $category->name }}</option>
                    @endforeach
                </select>

                <select id="filterStatus"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option value="">Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-xl p-6 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="border-b text-gray-600 uppercase text-xs bg-gray-50">
                <tr>
                    <th class="px-3 py-3"><input type="checkbox" class="form-checkbox"></th>
                    <th class="px-3 py-3">Image</th>
                    <th class="px-3 py-3">Sub Category</th>
                    <th class="px-3 py-3">Category</th>
                    <th class="px-3 py-3">Category Code</th>
                    <th class="px-3 py-3">Description</th>
                    <th class="px-3 py-3 text-center">Status</th>
                    <th class="px-3 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @foreach($subCategories as $sub)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-3 py-3">
                        <input type="checkbox" class="form-checkbox">
                    </td>

                    <td class="px-3 py-3">
                        @if($sub->image)
                            <img src="{{ asset('storage/'.$sub->image) }}" alt="sub-image" class="w-10 h-10 rounded-md object-cover">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="no image" class="w-10 h-10 rounded-md object-cover">
                        @endif
                    </td>


                    <td class="px-3 py-3 font-medium text-gray-800">{{ $sub->name }}</td>
                    <td class="px-3 py-3">{{ $sub->category->cat_name ?? 'N/A' }}</td>
                    <td class="px-3 py-3">{{ $sub->category_code ?? '-' }}</td>
                    <td class="px-3 py-3">{{ Str::limit($sub->description, 40) }}</td>

                    <td class="px-3 py-3 text-center">
                        @if($sub->status == 1)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Active</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">Inactive</span>
                        @endif
                    </td>

                    <td class="px-3 py-3 flex justify-center items-center gap-2">

                        <a href="{{ route('backend.sub_categories.show', $sub->id) }}" class="text-gray-600 hover:text-gray-800">
                            <i class="fa-solid fa-eye p-2 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-600"></i>
                        </a>

                        <a href="{{ route('backend.sub_categories.edit', $sub->id) }}"
                           class="p-2 rounded-md bg-blue-100 hover:bg-blue-200 text-blue-600">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('backend.sub_categories.destroy', $sub->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this sub-category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-2 rounded-md bg-red-100 hover:bg-red-200 text-red-600">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-5 text-sm text-gray-600">
            <div>
                <label for="rows" class="mr-2">Row Per Page</label>
                <select id="rows"
                        class="border border-gray-300 rounded-lg px-2 py-1 text-gray-700 focus:ring-2 focus:ring-blue-500">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                Entries
            </div>

            <div class="flex items-center gap-2">
                <button class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button class="p-2 rounded-full bg-orange-500 text-white">1</button>
                <button class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">2</button>
                <button class="p-2 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-700">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
