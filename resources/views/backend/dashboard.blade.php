@extends('backend.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Welcome, Admin</h1>
            <p class="text-sm text-gray-600">You have <span class="font-semibold text-orange-500">200+</span> Orders, Today</p>
        </div>

        <!-- Date Range -->
        <div class="mt-2 sm:mt-0">
            <input type="date" value="10/09/2025 - 10/15/2025" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
    </div>


    <!-- Main Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-orange-500 text-white rounded-xl p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Sales</p>
                    <h2 class="text-2xl font-semibold mt-2">$48,988,078</h2>
                </div>
                <span class="bg-white/20 px-2 py-1 text-xs rounded">+22%</span>
            </div>
        </div>

        <div class="bg-blue-900 text-white rounded-xl p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Sales Return</p>
                    <h2 class="text-2xl font-semibold mt-2">$16,478,145</h2>
                </div>
                <span class="bg-red-600 px-2 py-1 text-xs rounded">-22%</span>
            </div>
        </div>

        <div class="bg-emerald-700 text-white rounded-xl p-6 shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Purchase</p>
                    <h2 class="text-2xl font-semibold mt-2">$24,145,789</h2>
                </div>
                <span class="bg-white/20 px-2 py-1 text-xs rounded">+22%</span>
            </div>
        </div>

        <div class="bg-blue-700 text-white rounded-xl p-6 shadow relative">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium">Total Purchase Return</p>
                    <h2 class="text-2xl font-semibold mt-2">$18,458,747</h2>
                </div>
                <span class="bg-white/20 px-2 py-1 text-xs rounded">+22%</span>
            </div>
        </div>
    </div>

    <!-- Lower Summary Boxes -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-semibold">$8,458,798</h3>
            <p class="text-sm text-gray-600 mt-1">Profit</p>
            <p class="text-sm text-green-600 mt-3">+35% vs Last Month</p>
            <a href="#" class="text-blue-500 text-sm mt-2 inline-block font-medium hover:underline">View All</a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-semibold">$48,988,78</h3>
            <p class="text-sm text-gray-600 mt-1">Invoice Due</p>
            <p class="text-sm text-green-600 mt-3">+35% vs Last Month</p>
            <a href="#" class="text-blue-500 text-sm mt-2 inline-block font-medium hover:underline">View All</a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-semibold">$8,980,097</h3>
            <p class="text-sm text-gray-600 mt-1">Total Expenses</p>
            <p class="text-sm text-green-600 mt-3">+41% vs Last Month</p>
            <a href="#" class="text-blue-500 text-sm mt-2 inline-block font-medium hover:underline">View All</a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-semibold">$78,458,798</h3>
            <p class="text-sm text-gray-600 mt-1">Total Payment Returns</p>
            <p class="text-sm text-red-600 mt-3">-20% vs Last Month</p>
            <a href="#" class="text-blue-500 text-sm mt-2 inline-block font-medium hover:underline">View All</a>
        </div>
    </div>

</div>
@endsection
