@extends("backend.layouts.admin")



@section('title', 'Products List')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Products List</h2>
        <a href="{{ route('backend.products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Add New Product</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->sku }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->selling_price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('backend.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</a>
                        <a href="{{ route('backend.products.destroy', $product->id) }}" class="text-red-600 hover:text-red-900">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
