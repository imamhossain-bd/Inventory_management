@extends('backend.layouts.admin')

@section('title', 'Warranties')

@section('content')
<div class="p-6 bg-white rounded-lg shadow border border-gray-200">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Warranties</h2>
            <p class="text-gray-500 text-sm">Manage your warranties</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('backend.warranties.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2.5 rounded-md flex items-center gap-2 transition shadow-sm">
                <i class="fa-solid fa-circle-plus"></i>
                <span>Add Warranty</span>
            </a>
        </div>
    </div>

    <!-- Search and Status Filter -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
        <div class="relative w-full md:w-1/3">
            <input type="text" id="searchInput" placeholder="Search..."
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 bg-gray-50 text-gray-700
                          focus:bg-white focus:border-orange-400 focus:ring-2 focus:ring-orange-200 focus:outline-none shadow-sm transition">
            <i class="fa-solid fa-search absolute right-3 top-3 text-gray-400"></i>
        </div>

        <div>
            <button class="border border-gray-300 bg-gray-50 text-gray-700 px-4 py-2.5 rounded-lg hover:bg-gray-100 flex items-center gap-2">
                <span>Status</span>
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-gray-600 font-medium">
                    <th class="px-4 py-3"><input type="checkbox" /></th>
                    <th class="px-4 py-3">Warranty</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3">Duration</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="warrantyTable">
                @forelse ($warranties as $warranty)
                    <tr class="border-b hover:bg-orange-50 transition">
                        <td class="px-4 py-3">
                            <input type="checkbox" />
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $warranty->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $warranty->description ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-700">
                            {{ $warranty->duration }} {{ ucfirst($warranty->duration_type) }}
                        </td>
                        <td class="px-4 py-3">
                            @if($warranty->status)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    ● Active
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    ● Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right flex justify-end gap-2">
                            <a href="{{ route('backend.warranties.edit', $warranty->id) }}"
                               class="border border-gray-300 hover:bg-gray-100 p-2 rounded-md text-gray-600 transition">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('backend.warranties.destroy', $warranty->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this warranty?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="border border-gray-300 hover:bg-red-100 p-2 rounded-md text-red-600 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            No warranties found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center mt-4">
        <div class="text-sm text-gray-500">
            Row Per Page
            <select class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring-orange-200 focus:border-orange-400">
                <option>10</option>
                <option>25</option>
                <option>50</option>
            </select>
            Entries
        </div>

        <div>
            {{ $warranties->links() }}
        </div>
    </div>
</div>

<!-- JS Search Filter -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#warrantyTable tr');
        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endsection
