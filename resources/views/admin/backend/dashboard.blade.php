@extends('admin.loyout.master')
@section('content')

<div class="p-6">
  <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 text-sm">Welcome back! Here's an overview of your platform.</p>
    </div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Service Category -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 transition hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Service Category</p>
                    <p class="text-2xl font-bold text-gray-800">{{ App\Models\ServiceCategory::count() }}</p>
                    <span class="text-green-500 text-xs font-semibold">Active categories</span>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0-1c-1.11 0-2.08-.402-2.599-1M8 7c0-1.657 1.343-3 3-3s3 1.343 3 3M8 7c0 1.657 1.343 3 3 3s3-1.343 3-3M8 7v1m0-1c0 1.657-1.343 3-3 3s-3-1.343-3-3m0 0c0-1.657 1.343-3 3-3s3 1.343 3 3m0 0v1"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Service -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 transition hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Service</p>
                    <p class="text-2xl font-bold text-gray-800">{{ App\Models\Service::count() }}</p>
                    <span class="text-green-500 text-xs font-semibold">Available services</span>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Blogs Category -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 transition hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Blogs Category</p>
                    <p class="text-2xl font-bold text-gray-800">{{ App\Models\Category::count() ?? 0 }}</p>
                    <span class="text-purple-500 text-xs font-semibold">Blog categories</span>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Totals Insights -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 transition hover:shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Totals Insights</p>
                    <p class="text-2xl font-bold text-gray-800">{{ App\Models\InsightPages::count() ?? 0 }}</p>
                    <span class="text-green-500 text-xs font-semibold">+2.1% from last month</span>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
