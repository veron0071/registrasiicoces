@extends('layouts.admin')

@section('title', 'Participants - ICoCES-2026 Admin')
@section('page_title', 'Participants')

@section('content')
{{-- Page Header --}}
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Participants</h1>
        <p class="text-gray-500 text-sm mt-0.5">Manage and review all registered participants.</p>
    </div>
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.export.excel', request()->all()) }}"
           class="flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Excel
        </a>
        <a href="{{ route('admin.export.csv', request()->all()) }}"
           class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            CSV
        </a>
    </div>
</div>

{{-- Filter Card (collapsible on mobile) --}}
@php $hasActiveFilters = request()->anyFilled(['search','category','attendance','payment_status','participant_origin','country']); @endphp
<div class="card mb-5">

    {{-- Header — clickable toggle on mobile, static on md+ --}}
    <button type="button"
            id="filter-toggle"
            onclick="toggleFilter()"
            class="w-full flex items-center justify-between px-5 py-4 border-b border-gray-100 md:cursor-default"
            aria-expanded="{{ $hasActiveFilters ? 'true' : 'false' }}"
            aria-controls="filter-body">
        <div class="flex items-center gap-2">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Filter Participants</h3>
            @if($hasActiveFilters)
                <span class="inline-flex items-center justify-center w-5 h-5 bg-[#d90429] text-white text-xs font-bold rounded-full">
                    {{ count(array_filter(request()->only(['search','category','attendance','payment_status','participant_origin','country']))) }}
                </span>
            @endif
            {{-- Spinning loader (hidden by default) --}}
            <svg id="filter-spinner" class="hidden w-4 h-4 text-[#d90429] animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
            </svg>
        </div>
        {{-- Chevron icon — rotates when open, hidden on md+ --}}
        <svg id="filter-chevron"
             class="w-5 h-5 text-gray-400 transition-transform duration-300 md:hidden {{ $hasActiveFilters ? 'rotate-180' : '' }}"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Collapsible body --}}
    <div id="filter-body"
         class="filter-body overflow-hidden transition-all duration-300 ease-in-out
                {{ $hasActiveFilters ? '' : 'max-h-0 md:max-h-none' }}">
        <div class="p-5">
            <form id="filter-form" method="GET" action="{{ route('admin.participants') }}"
                  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-4 items-end">

                {{-- Search (debounce 500ms) --}}
                <div class="xl:col-span-2 md:col-span-2 sm:col-span-2">
                    <label class="form-label">Search Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" id="search-input" name="search"
                               class="form-input pl-9" placeholder="Type to search…"
                               value="{{ request('search') }}"
                               autocomplete="off">
                    </div>
                </div>

                {{-- Category --}}
                <div>
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select auto-filter">
                        <option value="">All</option>
                        <option value="presenter" {{ request('category') == 'presenter' ? 'selected' : '' }}>Presenter</option>
                        <option value="non_presenter" {{ request('category') == 'non_presenter' ? 'selected' : '' }}>Non-Presenter</option>
                    </select>
                </div>

                {{-- Attendance --}}
                <div>
                    <label class="form-label">Attendance</label>
                    <select name="attendance" class="form-select auto-filter">
                        <option value="">All</option>
                        <option value="onsite" {{ request('attendance') == 'onsite' ? 'selected' : '' }}>On-site</option>
                        <option value="online" {{ request('attendance') == 'online' ? 'selected' : '' }}>Online</option>
                    </select>
                </div>

                {{-- Payment Status --}}
                <div>
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-select auto-filter">
                        <option value="">All</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ request('payment_status') == 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="rejected" {{ request('payment_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                {{-- Origin --}}
                <div>
                    <label class="form-label">Origin</label>
                    <select name="participant_origin" class="form-select auto-filter">
                        <option value="">All</option>
                        <option value="ina" {{ request('participant_origin') == 'ina' ? 'selected' : '' }}>Domestic (INA)</option>
                        <option value="intl" {{ request('participant_origin') == 'intl' ? 'selected' : '' }}>International</option>
                    </select>
                </div>

                {{-- Country --}}
                <div>
                    <label class="form-label">Country</label>
                    <select name="country" class="form-select auto-filter">
                        <option value="">All</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Only show clear button if filters active, no more submit button --}}
                <div class="flex gap-2">
                    @if($hasActiveFilters)
                        <a href="{{ route('admin.participants') }}"
                           class="btn-outline-primary w-full py-2.5 text-sm flex items-center justify-center gap-1.5"
                           title="Clear all filters">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Clear
                        </a>
                    @else
                        <p class="text-xs text-gray-400 self-center italic w-full text-center">Auto-filters on change</p>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>

<script>
(function () {
    /* ── Collapsible filter ── */
    var body    = document.getElementById('filter-body');
    var chevron = document.getElementById('filter-chevron');
    var toggle  = document.getElementById('filter-toggle');
    var isOpen  = toggle.getAttribute('aria-expanded') === 'true';

    function applyDesktopState() {
        if (window.innerWidth >= 768) {
            body.style.maxHeight = '';
            body.style.overflow  = '';
        } else {
            body.style.maxHeight = isOpen ? body.scrollHeight + 'px' : '0px';
        }
    }
    applyDesktopState();
    window.addEventListener('resize', applyDesktopState);

    window.toggleFilter = function () {
        if (window.innerWidth >= 768) return;
        isOpen = !isOpen;
        toggle.setAttribute('aria-expanded', isOpen);
        body.style.maxHeight = isOpen ? body.scrollHeight + 'px' : '0px';
        chevron.style.transform = isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
    };

    /* ── Auto-submit helpers ── */
    var form    = document.getElementById('filter-form');
    var spinner = document.getElementById('filter-spinner');

    function submitForm() {
        spinner.classList.remove('hidden');
        form.submit();
    }

    /* ── Dropdowns: submit immediately on change ── */
    document.querySelectorAll('.auto-filter').forEach(function (sel) {
        sel.addEventListener('change', function () {
            submitForm();
        });
    });

    /* ── Search input: debounce 500 ms ── */
    var searchInput = document.getElementById('search-input');
    var debounceTimer;
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            submitForm();
        }, 500);
    });
    /* Also submit on Enter key immediately */
    searchInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            clearTimeout(debounceTimer);
            e.preventDefault();
            submitForm();
        }
    });
})();
</script>

{{-- Participants Table --}}
<div class="card overflow-hidden">

    {{-- ===== DESKTOP TABLE (md and above) ===== --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="bg-[#111111] text-white">
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">#</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Name</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Institution</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Country</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Category</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Fee</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Date</th>
                    <th class="px-5 py-3.5 font-semibold text-xs uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($participants as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3.5 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3.5 font-semibold text-gray-900">{{ $p->full_name }}</td>
                    <td class="px-5 py-3.5 text-gray-600 max-w-[160px] truncate">{{ $p->institution }}</td>
                    <td class="px-5 py-3.5 text-gray-600">{{ $p->country }}</td>
                    <td class="px-5 py-3.5">
                        <span class="inline-block bg-gray-100 text-gray-700 text-xs font-semibold px-2.5 py-1 rounded-full">{{ ucfirst(str_replace('_',' ',$p->category)) }}</span>
                        <span class="inline-block bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-full mt-1">{{ strtoupper($p->participant_origin) }}</span>
                    </td>
                    <td class="px-5 py-3.5 font-medium text-gray-800">{{ $p->fee_currency }} {{ number_format($p->fee_amount, 0) }}</td>
                    <td class="px-5 py-3.5">
                        @if($p->payment_status == 'pending')
                            <span class="badge-pending">Pending</span>
                        @elseif($p->payment_status == 'verified')
                            <span class="badge-verified">Verified</span>
                        @else
                            <span class="badge-rejected">Rejected</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-gray-500 text-xs">{{ $p->created_at->format('d M Y') }}</td>
                    <td class="px-5 py-3.5">
                        <a href="{{ route('admin.participants.show', $p->id) }}"
                           class="inline-flex items-center gap-1 border border-[#111111] text-[#111111] hover:bg-[#111111] hover:text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-200">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-5 py-12 text-center text-gray-400">
                        <svg class="w-10 h-10 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        No participants found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== MOBILE CARD LIST (below md) ===== --}}
    <div class="md:hidden">
        @forelse($participants as $p)
        <div class="p-4 border-b border-gray-100 last:border-b-0">
            {{-- Card Header: Number + Name + Status --}}
            <div class="flex items-start justify-between gap-2 mb-3">
                <div class="flex items-center gap-2 min-w-0">
                    <span class="flex-shrink-0 w-6 h-6 bg-gray-100 rounded-full text-gray-500 text-xs font-bold flex items-center justify-center">
                        {{ $loop->iteration }}
                    </span>
                    <div class="min-w-0">
                        <p class="font-bold text-gray-900 text-sm truncate">{{ $p->full_name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $p->institution }}</p>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    @if($p->payment_status == 'pending')
                        <span class="badge-pending">Pending</span>
                    @elseif($p->payment_status == 'verified')
                        <span class="badge-verified">Verified</span>
                    @else
                        <span class="badge-rejected">Rejected</span>
                    @endif
                </div>
            </div>

            {{-- Card Body: Details Grid --}}
            <div class="grid grid-cols-2 gap-x-4 gap-y-2 mb-3">
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Country</p>
                    <p class="text-sm text-gray-700 font-medium">{{ $p->country }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Fee</p>
                    <p class="text-sm text-gray-700 font-semibold">{{ $p->fee_currency }} {{ number_format($p->fee_amount, 0) }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Category</p>
                    <p class="text-sm">
                        <span class="inline-block bg-gray-100 text-gray-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ ucfirst(str_replace('_',' ',$p->category)) }}</span>
                    </p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Origin</p>
                    <p class="text-sm">
                        <span class="inline-block bg-blue-50 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full">{{ strtoupper($p->participant_origin) }}</span>
                    </p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Registered</p>
                    <p class="text-xs text-gray-600">{{ $p->created_at->format('d M Y') }}</p>
                </div>
            </div>

            {{-- Card Footer: Action --}}
            <a href="{{ route('admin.participants.show', $p->id) }}"
               class="w-full flex items-center justify-center gap-2 border border-[#111111] text-[#111111] hover:bg-[#111111] hover:text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                View Detail
            </a>
        </div>
        @empty
        <div class="px-5 py-12 text-center text-gray-400">
            <svg class="w-10 h-10 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            No participants found.
        </div>
        @endforelse
    </div>

    @if($participants->hasPages())
    <div class="px-4 sm:px-5 py-4 border-t border-gray-100 bg-gray-50">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3">

            {{-- Info text --}}
            <p class="text-xs text-gray-500 order-2 sm:order-1">
                Showing
                <span class="font-semibold text-gray-700">{{ $participants->firstItem() }}</span>
                –
                <span class="font-semibold text-gray-700">{{ $participants->lastItem() }}</span>
                of
                <span class="font-semibold text-gray-700">{{ $participants->total() }}</span>
                participants
            </p>

            {{-- Pagination controls --}}
            <div class="flex items-center gap-1 order-1 sm:order-2">

                {{-- Previous --}}
                @if($participants->onFirstPage())
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-300 bg-white border border-gray-200 cursor-not-allowed select-none">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Prev
                    </span>
                @else
                    <a href="{{ $participants->appends(request()->except('page'))->previousPageUrl() }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Prev
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $current   = $participants->currentPage();
                    $last      = $participants->lastPage();
                    $window    = 2; // pages shown around current
                    $start     = max(1, $current - $window);
                    $end       = min($last, $current + $window);
                @endphp

                {{-- First page + ellipsis --}}
                @if($start > 1)
                    <a href="{{ $participants->appends(request()->except('page'))->url(1) }}"
                       class="hidden sm:inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 transition-colors">1</a>
                    @if($start > 2)
                        <span class="hidden sm:inline-flex items-center justify-center w-8 h-8 text-xs text-gray-400">…</span>
                    @endif
                @endif

                {{-- Page window --}}
                @for($p = $start; $p <= $end; $p++)
                    @if($p === $current)
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-bold text-white bg-[#111111] border border-[#111111] shadow-sm">{{ $p }}</span>
                    @else
                        <a href="{{ $participants->appends(request()->except('page'))->url($p) }}"
                           class="hidden sm:inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 transition-colors">{{ $p }}</a>
                    @endif
                @endfor

                {{-- Ellipsis + last page --}}
                @if($end < $last)
                    @if($end < $last - 1)
                        <span class="hidden sm:inline-flex items-center justify-center w-8 h-8 text-xs text-gray-400">…</span>
                    @endif
                    <a href="{{ $participants->appends(request()->except('page'))->url($last) }}"
                       class="hidden sm:inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 transition-colors">{{ $last }}</a>
                @endif

                {{-- Page X of Y (mobile only) --}}
                <span class="sm:hidden inline-flex items-center justify-center px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-700 bg-white border border-gray-200">
                    {{ $current }} / {{ $last }}
                </span>

                {{-- Next --}}
                @if($participants->hasMorePages())
                    <a href="{{ $participants->appends(request()->except('page'))->nextPageUrl() }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors">
                        Next
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                @else
                    <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-300 bg-white border border-gray-200 cursor-not-allowed select-none">
                        Next
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                @endif

            </div>
        </div>
    </div>
    @endif
</div>
@endsection
