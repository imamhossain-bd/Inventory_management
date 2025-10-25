@extends('backend.layouts.admin')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">Expired Products</h1>
            <p class="text-gray-500 text-sm">Manage your expired products</p>
        </div>
        <div class="flex items-center gap-2">
            <button class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                <i class="fas fa-file-pdf"></i>
            </button>
            <button class="bg-green-500 text-white px-3 py-2 rounded hover:bg-green-600">
                <i class="fas fa-file-excel"></i>
            </button>
        </div>
    </div>

    {{-- Search and Filters --}}
    <div class="flex justify-between items-center mb-4">
        <div class="relative">
            <input type="text" placeholder="Search" class="border rounded-lg px-3 py-2 w-64 pl-8">
            <i class="fas fa-search absolute left-2 top-3 text-gray-400"></i>
        </div>
        <div class="flex gap-2">
            <select class="border rounded-lg px-3 py-2">
                <option>Product</option>
                <option>Category</option>
            </select>
            <select class="border rounded-lg px-3 py-2">
                <option>Sort By : Last 7 Days</option>
                <option>Last 30 Days</option>
                <option>Oldest</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600 uppercase text-xs">
                    <th class="p-3"><input type="checkbox"></th>
                    <th class="p-3">SKU</th>
                    <th class="p-3">Product</th>
                    <th class="p-3">Manufactured Date</th>
                    <th class="p-3">Expired Date</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expireProducts as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><input type="checkbox"></td>
                    <td class="p-3 font-medium text-gray-700">{{ $product->sku }}</td>
                    <td class="p-3 flex items-center gap-2">
                        <img src="{{ asset($product->image ?? 'assets/images/no-image.png') }}" alt="" class="w-8 h-8 rounded object-cover">
                        <span>{{ $product->name }}</span>
                    </td>
                    <td class="p-3 text-gray-600">{{ \Carbon\Carbon::parse($product->manufactured_date)->format('d M Y') }}</td>
                    <td class="p-3 text-gray-600">{{ \Carbon\Carbon::parse($product->expired_date)->format('d M Y') }}</td>
                    <td class="p-3 text-center flex justify-center gap-2">
                        <a href="{{ route('backend.expire-products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('backend.expire-products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
        <div>Row Per Page
            <select class="border rounded-lg px-2 py-1 ml-2">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div>
            {{ $expireProducts->links() }}
        </div>
    </div>
</div>
@endsection
