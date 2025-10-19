@extends('backend.layouts.admin')

@section('title', 'Variant Attributes')

@section('content')
<div class="p-6 bg-white rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Variant Attributes</h2>
        <a href="{{ route('backend.variants.create') }}"
            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md flex items-center space-x-2">
            <i class="fas fa-plus"></i> <span>Add Variant</span>
        </a>
    </div>

    {{-- Search & Filter --}}
    <div class="flex justify-between items-center mb-4">
        <div class="w-1/3">
            <input type="text" id="search" placeholder="Search"
                class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-orange-300">
        </div>
        <div>
            <select id="statusFilter" class="border rounded-md px-3 py-2">
                <option value="">Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left"><input type="checkbox"></th>
                    <th class="px-4 py-3 text-left">Variant</th>
                    <th class="px-4 py-3 text-left">Values</th>
                    <th class="px-4 py-3 text-left">Created Date</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="variantTable">
                @forelse($variants as $variant)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3"><input type="checkbox"></td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $variant->name }}</td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ implode(', ', $variant->value ?? []) }}
                        </td>
                        <td class="px-4 py-3 text-gray-600">{{ $variant->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            @if ($variant->status)
                                <span class="bg-green-100 text-green-700 text-sm px-2 py-1 rounded-full">Active</span>
                            @else
                                <span class="bg-red-100 text-red-700 text-sm px-2 py-1 rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 flex justify-center space-x-2">
                            <a href="{{ route('backend.variants.edit', $variant->id) }}"
                                class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('backend.variants.destroy', $variant->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this variant?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No variant attributes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4 flex justify-between items-center">
        <div>
            <label class="text-sm text-gray-600">Row Per Page</label>
            <select class="border rounded-md px-2 py-1 text-sm">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
        </div>
        <div>
            {{ $variants->links() }}
        </div>
    </div>
</div>

{{-- Optional Script for Search Filter --}}
<script>
    document.getElementById('search').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('#variantTable tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
