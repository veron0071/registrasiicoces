@extends('layouts.app')

@section('title', 'Registration Successful - ICoCES-2026')

@section('content')
<div class="flex justify-center items-start min-h-[70vh] py-4">
    <div class="w-full max-w-lg">


        {{-- ===== Main Card ===== --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">

            {{-- Green accent top --}}
            <div class="h-1.5 bg-gradient-to-r from-emerald-400 via-emerald-500 to-teal-500"></div>

            {{-- Content --}}
            <div class="px-8 pt-8 pb-6 text-center">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-2" style="animation: fadeInUp 0.5s ease 0.2s both;">
                    Registration Successful! 🎉
                </h1>
                <p class="text-gray-500 leading-relaxed" style="animation: fadeInUp 0.5s ease 0.35s both;">
                    Thank you{{ session('participant_name') ? ', ' : '' }}<strong class="text-gray-800">{{ session('participant_name', '') }}</strong>{{ session('participant_name') ? '!' : '!' }}
                    <br>Your registration for <span class="font-semibold text-[#d90429]">ICoCES-2026</span> has been received.
                </p>
            </div>

            {{-- ===== Info Steps ===== --}}
            <div class="px-8 pb-6 space-y-3" style="animation: fadeInUp 0.5s ease 0.5s both;">

                {{-- Step 1: Payment Pending --}}
                <div class="flex gap-4 p-4 bg-amber-50 rounded-xl border border-amber-100">
                    <div class="flex-shrink-0 w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-amber-800">Payment Under Review</p>
                        <p class="text-xs text-amber-700/80 mt-0.5 leading-relaxed">
                            Your payment proof has been submitted and is currently <span class="font-bold text-amber-700">pending verification</span> by our committee.
                        </p>
                    </div>
                </div>

                {{-- Step 2: Check Email --}}
                <div class="flex gap-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-blue-800">Check Your Email</p>
                        <p class="text-xs text-blue-700/80 mt-0.5 leading-relaxed">
                            A confirmation will be sent to
                            @if(session('participant_email'))
                                <span class="font-bold text-blue-700">{{ session('participant_email') }}</span>
                            @else
                                <span class="font-bold text-blue-700">your email address</span>
                            @endif
                            once your payment is verified. Please also check your spam folder.
                        </p>
                    </div>
                </div>

                {{-- Step 3: What's Next --}}
                <div class="flex gap-4 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                    <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-emerald-800">What Happens Next?</p>
                        <p class="text-xs text-emerald-700/80 mt-0.5 leading-relaxed">
                            After verification, you will receive your official conference pass and additional event details via email.
                        </p>
                    </div>
                </div>
            </div>

            
            {{-- ===== Actions ===== --}}
            <div class="px-8 pb-8" style="animation: fadeInUp 0.5s ease 0.8s both;">
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('registration.create') }}" class="btn-primary flex-1 py-3 text-sm justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Register Another
                    </a>
                    <a href="/" class="btn-outline-primary flex-1 py-3 text-sm justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Back to Home
                    </a>
                </div>

                {{-- Support note --}}
                <p class="text-center text-[11px] text-gray-400 mt-5 flex items-center justify-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Need help? Contact us at <a href="mailto:support@icoces.com" class="text-[#d90429] font-medium hover:underline">support@icoces.com</a>
                </p>
            </div>

        </div>

    </div>
</div>

<style>
    @keyframes successPop {
        0% { transform: scale(0) rotate(-10deg); opacity: 0; }
        60% { transform: scale(1.1) rotate(2deg); }
        100% { transform: scale(1) rotate(0deg); opacity: 1; }
    }
    @keyframes drawCheck {
        0% { stroke-dasharray: 100; stroke-dashoffset: 100; opacity: 0; }
        30% { opacity: 1; }
        100% { stroke-dasharray: 100; stroke-dashoffset: 0; opacity: 1; }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
