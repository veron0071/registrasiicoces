<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ICoCES-2026 - International Conference on Computer Engineering and Systems. Register now for the conference.">
    <title>@yield('title', 'ICoCES-2026 Registration')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

{{-- ===== NAVBAR ===== --}}
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/60">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between h-16">
            {{-- Brand --}}
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-9 h-9 bg-gradient-to-br from-[#d90429] to-[#a00320] rounded-xl flex items-center justify-center shadow-md shadow-[#d90429]/20 group-hover:shadow-lg group-hover:shadow-[#d90429]/30 transition-all duration-300 group-hover:scale-105">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
                <div class="flex items-baseline gap-1">
                    <span class="text-gray-900 font-bold text-xl tracking-tight">ICoCES</span>
                    <span class="text-[#d90429] font-semibold text-sm">2026</span>
                </div>
            </a>

            {{-- Nav Links --}}
            <div class="flex items-center gap-1.5">
                <a href="{{ route('admin.login') }}"
                   class="bg-gray-900 hover:bg-gray-800 text-white px-3 sm:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:shadow-lg hover:shadow-gray-900/20 flex items-center gap-1.5">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="hidden sm:inline">Admin Portal</span>
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- ===== MAIN CONTENT ===== --}}
<main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 py-10">
    @yield('content')
</main>

{{-- ===== FOOTER ===== --}}
<footer class="mt-auto border-t border-gray-200/60 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-sm">
            <div class="flex items-center gap-2 text-gray-500">
                <div class="w-6 h-6 bg-gradient-to-br from-[#d90429] to-[#a00320] rounded-md flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span>&copy; {{ date('Y') }} ICoCES. All rights reserved.</span>
            </div>
            <span class="text-gray-400 text-xs">International Conference on Computer Engineering and Systems</span>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
