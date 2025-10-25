
@extends('backend.layouts.app')


<div x-data="{ open: true }"
     :class="open ? 'w-64' : 'w-20'"
     class="bg-white border-r border-gray-200 text-gray-800 min-h-screen transition-all duration-300 flex flex-col relative">

    <!-- Logo + Collapse Button -->
    <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
        <div class="flex items-center space-x-2">
            <span x-show="open" class="font-bold text-xl text-gray-900">Dreams<span class="text-orange-500">POS</span></span>
        </div>

        <button @click="open = !open"
                class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition">
            <span x-show="open">&laquo;</span>
            <span x-show="!open">&raquo;</span>
        </button>
    </div>

    <!-- Menu -->
    <nav class="flex-1 px-4 py-4 text-sm space-y-4 overflow-y-auto">

        <!-- MAIN SECTION -->
        <div class="" style="border-bottom: 1px solid #e0e0e0">
            <h3 x-show="open" class="text-xs uppercase font-semibold text-gray-500 mb-2 tracking-wider">Main</h3>
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-3 py-2 rounded-md transition hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('dashboard') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-home w-6 text-center"></i>
                <span x-show="open" class="ml-2">Dashboard</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center px-3 py-2 rounded-md transition hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('admin.users.*') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-user-shield w-6 text-center"></i>
                <span x-show="open" class="ml-2">Super Admin</span>
            </a>

            <a href="#" class="flex items-center px-3 py-2 rounded-md transition hover:bg-orange-50 hover:text-orange-600">
                <i class="fas fa-cogs w-6 text-center"></i>
                <span x-show="open" class="ml-2">Application</span>
            </a>

            <a href="#" class="flex items-center px-3 py-2 rounded-md transition hover:bg-orange-50 hover:text-orange-600">
                <i class="fas fa-layer-group w-6 text-center"></i>
                <span x-show="open" class="ml-2">Layouts</span>
            </a>
        </div>

        <!-- INVENTORY SECTION -->
        <div class="" style="border-bottom: 1px solid #e0e0e0">
            <h3 x-show="open" class="text-xs uppercase font-semibold text-gray-500 mt-6 mb-2 tracking-wider">Inventory</h3>
            <a href="{{ route('backend.products.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.products.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-box-open w-6 text-center"></i>
                <span x-show="open" class="ml-2">Products</span>
            </a>

            <a href="{{ route('backend.products.create') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.products.create') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fa-solid fa-table w-6 text-center"></i>
                <span x-show="open" class="ml-2">Create Product</span>
            </a>

            <a href="{{ route('backend.expire-products.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.expire-products.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-clock w-6 text-center"></i>
                <span x-show="open" class="ml-2">Expired Products</span>
            </a>

            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.products.lowstock') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-arrow-down w-6 text-center"></i>
                <span x-show="open" class="ml-2">Low Stocks</span>
            </a>

            <a href="{{ route('backend.categories.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.categories.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-tags w-6 text-center"></i>
                <span x-show="open" class="ml-2">Category</span>
            </a>

            <a href="{{ route('backend.sub_categories.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.sub_categories.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-cubes w-6 text-center"></i>
                <span x-show="open" class="ml-2">Sub Category</span>
            </a>

            <a href="{{ route('backend.brands.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.brands.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-trademark w-6 text-center"></i>
                <span x-show="open" class="ml-2">Brands</span>
            </a>

            <a href="{{ route('backend.units.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.units.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-balance-scale w-6 text-center"></i>
                <span x-show="open" class="ml-2">Units</span>
            </a>

            <a href="{{ route('backend.variants.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.variants.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-palette w-6 text-center"></i>
                <span x-show="open" class="ml-2">Variant Attributes</span>
            </a>

            <a href="{{ route('backend.warranties.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.warranties.index') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-certificate w-6 text-center"></i>
                <span x-show="open" class="ml-2">Warranties</span>
            </a>

            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.products.outofstock') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-barcode w-6 text-center"></i>
                <span x-show="open" class="ml-2">Print Barcode</span>
            </a>

            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('backend.products.outofstock') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                <i class="fas fa-qrcode w-6 text-center"></i>
                <span x-show="open" class="ml-2">Print QR Code</span>
            </a>
        </div>

        <!-- STOCK SECTION -->
        <div class="" style="border-bottom: 1px solid #e0e0e0">
            <h3 x-show="open" class="text-xs uppercase font-semibold text-gray-500 mt-6 mb-2 tracking-wider">Stock</h3>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600 {}">
                <i class="fas fa-warehouse w-6 text-center"></i>
                <span x-show="open" class="ml-2">Manage Stock</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600">
                <i class="fas fa-sliders-h w-6 text-center"></i>
                <span x-show="open" class="ml-2">Stock Adjustment</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-orange-50 hover:text-orange-600">
                <i class="fas fa-exchange-alt w-6 text-center"></i>
                <span x-show="open" class="ml-2">Stock Transfer</span>
            </a>
        </div>

    </nav>
</div>

