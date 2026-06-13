@extends('layouts.admin')

@section('title', 'Dashboard - ICoCES-2026 Admin')
@section('page_title', 'Dashboard')

@section('content')
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Overview</h1>
        <p class="text-gray-500 text-sm mt-1">ICoCES-2026 registration statistics at a glance.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.export.excel') }}"
           class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Excel
        </a>
        <a href="{{ route('admin.export.csv') }}"
           class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            CSV
        </a>
    </div>
</div>

{{-- Primary Stats Row --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

    {{-- Total Participants --}}
    <div class="card p-6 border-l-4 border-[#d90429]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Total Participants</p>
            <div class="w-9 h-9 bg-[#d90429]/10 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-[#d90429]" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['total'] }}</p>
        <p class="text-xs text-gray-400 mt-1">All registered</p>
    </div>

    {{-- Presenters --}}
    <div class="card p-6 border-l-4 border-[#111111]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Presenters</p>
            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-gray-600" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['presenters'] }}</p>
        <p class="text-xs text-gray-400 mt-1">With paper submission</p>
    </div>

    {{-- Non-Presenters --}}
    <div class="card p-6 border-l-4 border-gray-400">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Non-Presenters</p>
            <div class="w-9 h-9 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-gray-500" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-gray-900">{{ $stats['non_presenters'] }}</p>
        <p class="text-xs text-gray-400 mt-1">Attendees only</p>
    </div>

    {{-- Verified Payments --}}
    <div class="card p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Verified Payments</p>
            <div class="w-9 h-9 bg-green-50 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-green-600" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-green-600">{{ $stats['verified'] }}</p>
        <p class="text-xs text-gray-400 mt-1">Payments approved</p>
    </div>
</div>

{{-- Secondary Stats Row --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

    {{-- Pending --}}
    <div class="card p-6">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Pending</p>
            <div class="w-9 h-9 bg-yellow-50 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-yellow-500" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-yellow-500">{{ $stats['pending'] }}</p>
        <p class="text-xs text-gray-400 mt-1">Awaiting verification</p>
    </div>

    {{-- Rejected --}}
    <div class="card p-6">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Rejected</p>
            <div class="w-9 h-9 bg-red-50 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-red-500" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-red-500">{{ $stats['rejected'] }}</p>
        <p class="text-xs text-gray-400 mt-1">Payments rejected</p>
    </div>

    {{-- Domestic --}}
    <div class="card p-6">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">Domestic (INA)</p>
            <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-blue-500" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-blue-600">{{ $stats['domestic'] }}</p>
        <p class="text-xs text-gray-400 mt-1">Indonesian participants</p>
    </div>

    {{-- International --}}
    <div class="card p-6">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-500">International</p>
            <div class="w-9 h-9 bg-purple-50 rounded-lg flex items-center justify-center">
                <svg class="w-4.5 h-4.5 text-purple-500" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-purple-600">{{ $stats['international'] }}</p>
        <p class="text-xs text-gray-400 mt-1">From abroad</p>
    </div>

</div>
@endsection
