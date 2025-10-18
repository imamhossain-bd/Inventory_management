@extends('backend.layouts.admin')

@section('title', 'Category Details')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        {{-- Header / Actions --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Category Details</h1>
                <p class="text-sm text-gray-500">A clean invoice-style detail view for categories</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('backend.categories.index') }}" class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>

                <button onclick="window.print()" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                    <i class="fa-solid fa-print"></i>
                    Print
                </button>
            </div>
        </div>

        {{-- Invoice Card --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            {{-- Top bar with company + meta --}}
            <div class="p-6 border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        {{-- Logo Placeholder --}}
                        <div class="w-16 h-16 flex items-center justify-center rounded-md bg-indigo-50 text-indigo-600 font-bold text-lg">
                            {{ strtoupper(substr($categories->cat_name ?? 'CAT', 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $categories->cat_name }}</h2>
                            <p class="text-sm text-gray-500">Category</p>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600">
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="text-xs text-gray-400">Code</div>
                                <div class="font-medium text-gray-800">{{ $categories->category_code }}</div>
                            </div>

                            <div>
                                <div class="text-xs text-gray-400">Slug</div>
                                <div class="font-medium text-gray-800">{{ $categories->cat_slug }}</div>
                            </div>

                            <div>
                                <div class="text-xs text-gray-400">Created</div>
                                <div class="font-medium text-gray-800">
                                    {{ optional($categories->created_at)->format('M d, Y') ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body with details --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Left column: Details box --}}
                    <div class="md:col-span-2">
                        <div class="mb-4">
                            <h3 class="text-sm text-gray-500 uppercase tracking-wide">Description</h3>
                            <div class="mt-2 text-gray-700 leading-relaxed bg-gray-50 p-4 rounded">
                                @if($categories->cat_description)
                                    {!! nl2br(e($categories->cat_description)) !!}
                                @else
                                    <span class="text-gray-400">No description provided.</span>
                                @endif
                            </div>
                        </div>

                        {{-- Example: related info or notes --}}
                        <div class="mt-6">
                            <h3 class="text-sm text-gray-500 uppercase tracking-wide">Notes</h3>
                            <div class="mt-2 text-sm text-gray-600">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Use this category for grouping similar products.</li>
                                    <li>Category code is auto-generated and unique.</li>
                                    <li>You can edit slug and description from the edit page.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Right column: summary card --}}
                    <div>
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex items-center justify-between mb-3">
                                <div class="text-sm text-gray-500">Status</div>
                                <div class="text-sm font-medium">
                                    @if(isset($categories->status) && $categories->status === 'inactive')
                                        <span class="px-2 py-1 rounded text-red-700 bg-red-100">Inactive</span>
                                    @else
                                        <span class="px-2 py-1 rounded text-green-700 bg-green-100">Active</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-xs text-gray-400">Total Products</div>
                                {{-- If you have relation products_count --}}
                                <div class="text-lg font-semibold text-gray-800 mt-1">
                                    {{ $categories->products_count ?? '—' }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-xs text-gray-400">Last Updated</div>
                                <div class="text-sm text-gray-700 mt-1">
                                    {{ optional($categories->updated_at)->diffForHumans() ?? '—' }}
                                </div>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('backend.categories.edit', $categories->id) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Category
                                </a>
                            </div>
                        </div>

                        {{-- QR or small print area --}}
                        <div class="mt-4 text-center text-xs text-gray-400">
                            <div class="mb-2">Reference</div>
                            <div class="font-mono text-sm text-gray-700 break-words">{{ $categories->category_code }}</div>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="my-6 border-t"></div>

                {{-- Footer / small details --}}
                <div class="text-xs text-gray-500">
                    <div>Viewed on: {{ now()->format('M d, Y H:i') }}</div>
                    <div class="mt-1">Generated by: <span class="text-gray-700 font-medium">{{ auth()->user()->name ?? 'System' }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Print styles for a cleaner print --}}
<style>
    @media print {
        body { background: white; }
        .no-print { display: none !important; }
        .shadow { box-shadow: none !important; }
    }
</style>
@endsection
