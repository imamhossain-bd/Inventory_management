@extends("backend.layouts.admin")

@section('title', 'Product List')

@section('content')
<div class="p-6 bg-white rounded-lg shadow border border-gray-200">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Product List</h2>
            <p class="text-gray-500 text-sm">Manage your products</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-file-pdf"></i><span>PDF</span>
            </button>
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-file-excel"></i><span>Excel</span>
            </button>
            <a href="{{ route('backend.products.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-plus"></i><span>Add Product</span>
            </a>
            <button class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                <i class="fas fa-upload"></i><span>Import</span>
            </button>
        </div>
    </div>

    <!-- Search + Filter -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center w-1/3">
            <input type="text" placeholder="Search"
                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:border-orange-400">
        </div>
        <div class="flex gap-2">
            <select class="border border-gray-300 rounded-md px-3 py-2 text-gray-600 focus:ring-orange-300 focus:border-orange-400">
                <option>Category</option>
                <option>Electronics</option>
                <option>Furniture</option>
            </select>
            <select class="border border-gray-300 rounded-md px-3 py-2 text-gray-600 focus:ring-orange-300 focus:border-orange-400">
                <option>Brand</option>
                <option>Apple</option>
                <option>Samsung</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr class="text-gray-600 uppercase text-xs">
                    <th class="px-4 py-3 text-left">
                        <input type="checkbox" class="form-checkbox rounded text-orange-500">
                    </th>
                    <th class="px-4 py-3 text-left">SKU</th>
                    <th class="px-4 py-3 text-left">Product Name</th>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Brand</th>
                    <th class="px-4 py-3 text-left">Price</th>
                    <th class="px-4 py-3 text-left">Unit</th>
                    <th class="px-4 py-3 text-left">Qty</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <input type="checkbox" class="form-checkbox rounded text-orange-500">
                    </td>
                    <td class="px-4 py-3 font-medium text-gray-700">{{ $product->sku }}</td>
                    <td class="px-4 py-3 flex items-center space-x-3">
                        @if($product->image)
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="" class="w-8 h-8 rounded object-cover">
                        @else
                            <div class="w-8 h-8 bg-gray-200 rounded"></div>
                        @endif
                        <span>{{ $product->name }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $product->categories->cat_name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $product->brand->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-gray-700">${{ number_format($product->total_amount, 2) }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $product->unit->name ?? 'Pc' }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $product->stock }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('backend.products.show', $product->id) }}"
                           class="text-gray-600 hover:text-blue-600" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('backend.products.edit', $product->id) }}"
                           class="text-gray-600 hover:text-orange-600" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('backend.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-600 hover:text-red-600" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer Pagination -->
    <div class="flex justify-between items-center mt-6 text-sm text-gray-600">
        <div>
            <label>Row Per Page:</label>
            <select class="border border-gray-300 rounded-md px-2 py-1 ml-2 focus:ring-orange-300 focus:border-orange-400">
                <option>10</option>
                <option>20</option>
                <option>50</option>
            </select>
            <span class="ml-2">Entries</span>
        </div>
        <div class="flex items-center space-x-2">
            <button class="px-3 py-1 border rounded-md text-gray-500 hover:bg-gray-100"><i class="fas fa-chevron-left"></i></button>
            <button class="px-3 py-1 border rounded-md bg-orange-500 text-white">1</button>
            <button class="px-3 py-1 border rounded-md text-gray-500 hover:bg-gray-100">2</button>
            <button class="px-3 py-1 border rounded-md text-gray-500 hover:bg-gray-100"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>
</div>
@endsection
