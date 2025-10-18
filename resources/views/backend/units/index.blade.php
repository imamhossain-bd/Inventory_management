@extends('backend.layouts.admin')

@section('title', 'Units')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Units</h1>
            <p class="text-gray-500 text-sm">Manage your units</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Export Buttons -->
            <button class="p-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-600 shadow-sm transition">
                <i class="fa-solid fa-file-pdf"></i>
            </button>
            <button class="p-2 rounded-lg bg-green-100 hover:bg-green-200 text-green-600 shadow-sm transition">
                <i class="fa-solid fa-file-excel"></i>
            </button>

            <!-- Refresh -->
            <button onclick="window.location.reload()" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 shadow-sm transition">
                <i class="fa-solid fa-rotate-right"></i>
            </button>

            <!-- Add Unit -->
            <a href="{{ route('backend.units.create') }}"
               class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-medium shadow-md transition">
                + Add Unit
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white shadow-md rounded-xl border border-gray-200 p-6">
        <!-- Search & Filter -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
            <div class="relative w-full md:w-1/3">
                <input type="text" id="search" placeholder="Search..."
                    class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2.5 text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fa-solid fa-search"></i>
                </span>
            </div>

            <div>
                <select id="statusFilter" class="border border-gray-300 rounded-lg px-3 py-2.5 bg-gray-50 text-gray-700 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 focus:outline-none transition">
                    <option value="">Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left w-12">
                            <input type="checkbox" class="rounded border-gray-300 focus:ring-blue-400">
                        </th>
                        <th class="px-4 py-3 text-left font-medium">Unit</th>
                        <th class="px-4 py-3 text-left font-medium">Short Name</th>
                        <th class="px-4 py-3 text-left font-medium">No. of Products</th>
                        <th class="px-4 py-3 text-left font-medium">Created Date</th>
                        <th class="px-4 py-3 text-left font-medium">Status</th>
                        <th class="px-4 py-3 text-center font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                    @forelse($units as $unit)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="rounded border-gray-300 focus:ring-blue-400">
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $unit->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $unit->short_name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $unit->products_count ?? 0 }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $unit->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                @if($unit->status == 1)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                        ● Active
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                                        ● Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex items-center justify-center gap-3">
                                <a href="{{ route('backend.units.edit', $unit->id) }}"
                                   class="p-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-md transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('backend.units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-md transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">No units found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <div class="text-gray-600 text-sm">
                Row Per Page
                <select class="border border-gray-300 rounded-lg px-2 py-1 text-sm ml-1">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                </select>
                Entries
            </div>
            <div>
                {{ $units->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
