<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ICoCES-2026 Admin Panel">
    <title>@yield('title', 'Admin - ICoCES-2026')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 antialiased">

<div class="flex min-h-screen">

    {{-- ===== MOBILE OVERLAY ===== --}}
    @auth('admin')
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"
         onclick="closeSidebar()"></div>

    {{-- ===== SIDEBAR ===== --}}
    <aside id="sidebar"
           class="w-64 shrink-0 bg-[#111111] flex flex-col min-h-screen fixed top-0 left-0 z-40 shadow-xl
                  transition-transform duration-300 ease-in-out
                  -translate-x-full lg:translate-x-0">
        {{-- Logo + Close button (mobile) --}}
        <div class="px-6 py-6 border-b border-white/10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-[#d90429] rounded-lg flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-bold text-sm leading-tight">ICoCES-2026</p>
                        <p class="text-gray-400 text-xs">Admin Panel</p>
                    </div>
                </div>
                {{-- Close button for mobile --}}
                <button onclick="closeSidebar()"
                        class="lg:hidden text-gray-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors"
                        aria-label="Close sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-1">
            <p class="text-gray-500 text-xs font-semibold uppercase tracking-widest px-3 mb-3">Menu</p>

            <a href="{{ route('admin.dashboard') }}"
               onclick="closeSidebar()"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('admin.dashboard') ? 'bg-[#d90429] text-white shadow-sm shadow-[#d90429]/40' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4.5 h-4.5 flex-shrink-0" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.participants') }}"
               onclick="closeSidebar()"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                      {{ request()->routeIs('admin.participants*') ? 'bg-[#d90429] text-white shadow-sm shadow-[#d90429]/40' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                <svg class="w-4.5 h-4.5 flex-shrink-0" style="width:1.125rem;height:1.125rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Participants
            </a>
        </nav>

        {{-- Quick Stats --}}
        @if(isset($sidebarStats))
        <div class="px-6 py-4 border-t border-white/10">
            <p class="text-gray-500 text-xs font-semibold uppercase tracking-widest mb-3">Quick Stats</p>
            <div class="space-y-2.5">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-400">Total Pendaftar</span>
                    <span class="bg-[#d90429]/20 text-[#ff4d6d] font-bold px-2 py-0.5 rounded">{{ $sidebarStats['total'] }}</span>
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">Presenter</span>
                    <span class="bg-white/10 text-gray-200 font-bold px-2 py-0.5 rounded">{{ $sidebarStats['presenters'] }}</span>
                </div>
                <div class="flex items-center justify-between text-xs">
                    <span class="text-gray-400 font-medium">Non-Presenter</span>
                    <span class="bg-white/10 text-gray-200 font-bold px-2 py-0.5 rounded">{{ $sidebarStats['non_presenters'] }}</span>
                </div>
            </div>
        </div>
        @endif

        {{-- Logout --}}
        <div class="px-3 py-4 border-t border-white/10">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 text-gray-400 hover:text-white hover:bg-red-600/20 rounded-lg text-sm font-medium transition-all duration-200">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>
    @endauth

    {{-- ===== MAIN CONTENT AREA ===== --}}
    <div class="flex-1 flex flex-col min-w-0 {{ auth('admin')->check() ? 'lg:ml-64' : '' }}">

        @auth('admin')
        {{-- Top Navbar --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-200 shadow-sm">
            <div class="px-4 lg:px-6 py-3 lg:py-4 flex items-center justify-between gap-3">
                {{-- Left: Hamburger + Title --}}
                <div class="flex items-center gap-3 min-w-0">
                    {{-- Hamburger button (mobile only) --}}
                    <button id="sidebar-toggle"
                            onclick="openSidebar()"
                            class="lg:hidden flex-shrink-0 p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors"
                            aria-label="Open navigation menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <div class="min-w-0">
                        <h2 class="text-base lg:text-lg font-bold text-gray-800 truncate">@yield('page_title', 'Admin Panel')</h2>
                        <p class="text-xs text-gray-400 mt-0.5 hidden sm:block">ICoCES-2026 Management System</p>
                    </div>
                </div>
                {{-- Right: Admin avatar --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-8 h-8 bg-[#d90429] rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700 hidden sm:block">Administrator</span>
                </div>
            </div>
        </header>
        @endauth

        {{-- Page Content --}}
        <main class="flex-1 p-4 lg:p-6 overflow-x-hidden">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert-success flex items-center gap-2 mb-6">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error mb-6">
                    <p class="font-bold mb-1">Please fix the following errors:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>

<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    }
    // Close sidebar on large screens resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            document.getElementById('sidebar-overlay').classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
</script>

</body>
</html>
