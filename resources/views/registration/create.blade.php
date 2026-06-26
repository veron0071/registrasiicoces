@extends('layouts.app')

@section('title', 'Registration Form - ICoCES-2026')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<div class="relative overflow-hidden -mt-10 mb-10">
    {{-- Decorative Background --}}
    <div class="absolute inset-0 bg-gradient-to-br from-[#d90429]/5 via-transparent to-[#d90429]/3"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#d90429]/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-[#d90429]/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

    <div class="relative text-center py-12 px-4">
        {{-- Decorative Academic Icon --}}
        <div class="flex justify-center mb-5">
            <div class="w-16 h-16 bg-gradient-to-br from-[#d90429] to-[#a00320] rounded-2xl flex items-center justify-center shadow-lg shadow-[#d90429]/25 rotate-3 hover:rotate-0 transition-transform duration-300">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                </svg>
            </div>
        </div>

        <span class="inline-block bg-[#d90429]/10 text-[#d90429] text-[11px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4 border border-[#d90429]/15">Open Registration</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">
            Conference <span class="text-[#d90429]">Registration</span>
        </h1>
        <p class="mt-3 text-gray-500 max-w-lg mx-auto text-[15px] leading-relaxed">
            Join the <strong class="text-gray-700">International Conference on Community Engagement for Sustainability 2026</strong>. Fill in the form below to secure your spot.
        </p>

        {{-- Step Indicators --}}
        <div class="flex items-center justify-center gap-0 mt-8" id="step-indicators">
            <div class="step-indicator step-indicator--active" data-step="1">
                <div class="step-indicator__dot">
                    <span>1</span>
                </div>
                <span class="step-indicator__label hidden xs:block sm:block">Personal Info</span>
            </div>
            <div class="step-indicator__line" style="width:2rem;"></div>
            <div class="step-indicator" data-step="2">
                <div class="step-indicator__dot">
                    <span>2</span>
                </div>
                <span class="step-indicator__label hidden xs:block sm:block">Conference Details</span>
            </div>
            <div class="step-indicator__line" style="width:2rem;"></div>
            <div class="step-indicator" data-step="3">
                <div class="step-indicator__dot">
                    <span>3</span>
                </div>
                <span class="step-indicator__label hidden xs:block sm:block">Payment</span>
            </div>
        </div>
    </div>
</div>

{{-- ===== FORM ===== --}}
<div class="flex justify-center pb-4">
    <div class="w-full max-w-2xl">

        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-5 flex gap-3">
                <div class="flex-shrink-0 mt-0.5">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="font-semibold text-red-800 text-sm mb-1">Please review your inputs:</p>
                    <ul class="text-sm text-red-700 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-start gap-1.5">
                                <span class="text-red-400 mt-1">•</span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <form action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data" id="registration-form">
                @csrf

                {{-- Hidden inputs for card selectors --}}
                <input type="hidden" name="category" id="category" value="{{ old('category') }}">
                <input type="hidden" name="cohost" id="cohost" value="{{ old('cohost') }}">
                <input type="hidden" name="participant_origin" id="participant_origin" value="{{ old('participant_origin') }}">

                {{-- ============================================================ --}}
                {{-- STEP 1 — Personal Information                                --}}
                {{-- ============================================================ --}}
                <div class="form-step" data-step="1">
                    <div class="px-4 sm:px-8 pt-8 pb-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-[#d90429]/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#d90429]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Personal Information</h2>
                                <p class="text-xs text-gray-500">Tell us about yourself and your affiliation</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 sm:px-8 pb-8 space-y-5">
                        {{-- Full Name --}}
                        <div>
                            <label class="form-label" for="full_name">
                                Full Name <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" id="full_name" name="full_name" class="form-input pl-11"
                                       placeholder="e.g. Dr. John Doe" value="{{ old('full_name') }}" required>
                            </div>
                        </div>

                        {{-- Institution --}}
                        <div>
                            <label class="form-label" for="institution">
                                Institution / University <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input type="text" id="institution" name="institution" class="form-input pl-11"
                                       placeholder="e.g. Universitas Brawijaya" value="{{ old('institution') }}" required>
                            </div>
                        </div>

                        {{-- Country --}}
                        <div>
                            <label class="form-label" for="country">
                                Country <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <select id="country" name="country" class="form-input pl-11" required>
                                    <option value="">Select your country</option>
                                    @foreach(config('countries') as $code => $name)
                                        <option value="{{ $name }}" {{ old('country') == $name ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="form-label" for="email">
                                Email Address <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" class="form-input pl-11"
                                       placeholder="you@university.edu" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="form-label" for="phone">
                                Phone / WhatsApp Number <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="text" id="phone" name="phone" class="form-input pl-11"
                                       placeholder="e.g. +62 812 3456 7890" value="{{ old('phone') }}" required>
                            </div>
                        </div>

                        {{-- Next Button --}}
                        <div class="pt-3">
                            <button type="button" class="btn-primary w-full py-3.5 text-[15px]" onclick="goToStep(2)">
                                Continue to Conference Details
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ============================================================ --}}
                {{-- STEP 2 — Registration Details                                --}}
                {{-- ============================================================ --}}
                <div class="form-step hidden" data-step="2">
                    <div class="px-4 sm:px-8 pt-8 pb-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-[#d90429]/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#d90429]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Conference Details</h2>
                                <p class="text-xs text-gray-500">Select your participation category and attendance mode</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 sm:px-8 pb-8 space-y-6">

                        {{-- Cohost --}}
                        <div>
                            <label class="form-label mb-3 block">
                                Cohost Participation <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3" id="cohost_group">
                                <button type="button" data-group="cohost" data-value="yes"
                                    class="option-card {{ old('cohost') == 'yes' ? 'option-card--active' : '' }}">
                                    <div class="option-card__icon bg-purple-50 text-purple-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="text-left min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm">Yes</p>
                                        
                                    </div>
                                    <div class="option-card__check">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                                <button type="button" data-group="cohost" data-value="no"
                                    class="option-card {{ old('cohost') == 'no' ? 'option-card--active' : '' }}">
                                    <div class="option-card__icon bg-amber-50 text-amber-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="text-left min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm">No</p>
                                        
                                    </div>
                                    <div class="option-card__check">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div>
                            <label class="form-label mb-3 block">
                                Participation Category <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3" id="category_group">
                                <button type="button" data-group="category" data-value="presenter"
                                    class="option-card {{ old('category') == 'presenter' ? 'option-card--active' : '' }}">
                                    <div class="option-card__icon bg-amber-50 text-amber-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="text-left min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm">Presenter</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">Present a research paper</p>
                                    </div>
                                    <div class="option-card__check">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                                <button type="button" data-group="category" data-value="non_presenter"
                                    class="option-card {{ old('category') == 'non_presenter' ? 'option-card--active' : '' }}">
                                    <div class="option-card__icon bg-blue-50 text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div class="text-left min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm">Non-Presenter</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">Attend as participant</p>
                                    </div>
                                    <div class="option-card__check">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {{-- Origin --}}
                        <div>
                            <label class="form-label mb-3 block">
                                Participant Origin <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3" id="origin_group">
                                <button type="button" data-group="participant_origin" data-value="ina"
                                    class="option-card {{ old('participant_origin') == 'ina' ? 'option-card--active' : '' }}">
                                    <div class="option-card__icon bg-red-50 text-red-600">
                                        <span class="text-lg leading-none">🇮🇩</span>
                                    </div>
                                    <div class="text-left min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm">Domestic</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">Indonesia (INA)</p>
                                    </div>
                                    <div class="option-card__check">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                                <button type="button" data-group="participant_origin" data-value="intl"
                                    class="option-card {{ old('participant_origin') == 'intl' ? 'option-card--active' : '' }}">
                                    <div class="option-card__icon bg-sky-50 text-sky-600">
                                        <span class="text-lg leading-none">🌏</span>
                                    </div>
                                    <div class="text-left min-w-0">
                                        <p class="font-semibold text-gray-800 text-sm">International</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5 leading-snug">Outside Indonesia</p>
                                    </div>
                                    <div class="option-card__check">
                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {{-- Paper Title (Presenter only) --}}
                        <div id="paper_title_container" class="hidden">
                            <label class="form-label" for="paper_title">
                                Paper Title <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                                <input type="text" id="paper_title" name="paper_title" class="form-input pl-11"
                                       placeholder="Enter your research paper title" value="{{ old('paper_title') }}">
                            </div>
                            <p class="mt-1.5 text-[11px] text-gray-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                                Required for Presenter category only
                            </p>
                        </div>

                        <div id="fee_container" class="hidden">
                            <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-4 sm:p-5 text-white overflow-hidden">
                                {{-- Decorative --}}
                                <div class="absolute top-0 right-0 w-32 h-32 bg-[#d90429]/20 rounded-full blur-2xl -translate-y-1/2 translate-x-1/3"></div>
                                <div class="relative">
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-gray-400 mb-1">Registration Fee</p>
                                            <p class="text-2xl sm:text-3xl font-extrabold text-white truncate" id="fee_amount"></p>
                                        </div>
                                        <div class="w-11 h-11 sm:w-12 sm:h-12 flex-shrink-0 bg-[#d90429] rounded-xl flex items-center justify-center shadow-lg shadow-[#d90429]/30">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-white/10">
                                        <p class="text-sm text-gray-300">
                                            Transfer to: <strong class="text-white">BRI — 032501122420506</strong><br>
                                            <span class="text-xs text-gray-400">(a.n. Linda Indiyarti Putri)</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Navigation --}}
                        <div class="flex gap-3 pt-3">
                            <button type="button" class="btn-outline-primary flex-1 py-3.5 text-[15px]" onclick="goToStep(1)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                                </svg>
                                Back
                            </button>
                            <button type="button" class="btn-primary flex-[2] py-3.5 text-[15px]" onclick="goToStep(3)">
                                Continue to Payment
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ============================================================ --}}
                {{-- STEP 3 — Payment Proof                                       --}}
                {{-- ============================================================ --}}
                <div class="form-step hidden" data-step="3">
                    <div class="px-4 sm:px-8 pt-8 pb-2">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-[#d90429]/10 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#d90429]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Payment Proof</h2>
                                <p class="text-xs text-gray-500">Upload your transfer receipt to complete registration</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 sm:px-8 pb-8 space-y-5">

                        {{-- Drag & Drop Upload Area --}}
                        <div>
                            <label class="form-label mb-2">
                                Upload Payment Receipt <span class="text-[#d90429]">*</span>
                            </label>
                            <div class="file-upload-zone" id="file-upload-zone">
                                <input type="file" id="payment_proof" name="payment_proof"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                       accept=".jpg,.jpeg,.png,.pdf" required>
                                <div class="text-center pointer-events-none">
                                    <div class="w-14 h-14 mx-auto bg-[#d90429]/10 rounded-2xl flex items-center justify-center mb-3">
                                        <svg class="w-7 h-7 text-[#d90429]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-700 mb-1" id="file-upload-text">
                                        Click to upload or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-400">JPG, JPEG, PNG, or PDF (max. 2MB)</p>
                                </div>
                            </div>
                            <div id="file-name-display" class="hidden mt-2 flex items-center gap-2 text-sm text-gray-600 bg-gray-50 rounded-lg px-3 py-2">
                                <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span id="file-name-text" class="truncate"></span>
                            </div>
                        </div>

                        {{-- Summary Box --}}
                        <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Registration Summary</p>
                            <div class="space-y-2 text-sm" id="summary-box">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Cohost</span>
                                    <span class="font-medium text-gray-800" id="summary-category">—</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Category</span>
                                    <span class="font-medium text-gray-800" id="summary-attendance">—</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Origin</span>
                                    <span class="font-medium text-gray-800" id="summary-origin">—</span>
                                </div>
                                <div class="border-t border-dashed border-gray-200 my-2"></div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500 font-semibold">Total Fee</span>
                                    <span class="font-bold text-[#d90429]" id="summary-fee">—</span>
                                </div>
                            </div>
                        </div>

                        {{-- Navigation --}}
                        <div class="flex gap-3 pt-1">
                            <button type="button" class="btn-outline-primary flex-1 py-3.5 text-[15px]" onclick="goToStep(2)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                                </svg>
                                Back
                            </button>
                            <button type="submit" class="btn-primary flex-[2] py-3.5 text-[15px]" id="submit-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                Submit Registration
                            </button>
                        </div>

                        {{-- Trust note --}}
                        <div class="flex items-center justify-center gap-2 text-xs text-gray-400 pt-2">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            Your data is secure and will only be used for conference purposes
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryInput = document.getElementById('category');
        const cohostInput = document.getElementById('cohost');
        const originInput = document.getElementById('participant_origin');
        const paperTitleContainer = document.getElementById('paper_title_container');
        const paperTitleInput = document.getElementById('paper_title');
        const feeContainer = document.getElementById('fee_container');
        const feeAmountText = document.getElementById('fee_amount');

        // ─── Step Navigation ───
        let currentStep = 1;
        window.goToStep = function(step) {
            // Validation before advancing
            if (step > currentStep) {
                if (currentStep === 1) {
                    const fields = ['full_name', 'institution', 'country', 'email', 'phone'];
                    for (const fid of fields) {
                        const el = document.getElementById(fid);
                        if (!el.value.trim()) {
                            el.focus();
                            el.classList.add('!border-red-400');
                            setTimeout(() => el.classList.remove('!border-red-400'), 2000);
                            return;
                        }
                    }
                }
                if (currentStep === 2) {
                    if (!cohostInput?.value || !categoryInput?.value || !originInput?.value) {
                        return; // silent — user must select all options
                    }
                    if (categoryInput.value === 'presenter' && !paperTitleInput?.value.trim()) {
                        paperTitleInput.focus();
                        return;
                    }
                }
            }

            currentStep = step;
            document.querySelectorAll('.form-step').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelector(`.form-step[data-step="${step}"]`).classList.remove('hidden');

            // Update step indicators
            document.querySelectorAll('.step-indicator').forEach(ind => {
                const indStep = parseInt(ind.dataset.step);
                ind.classList.remove('step-indicator--active', 'step-indicator--completed');
                if (indStep === step) {
                    ind.classList.add('step-indicator--active');
                } else if (indStep < step) {
                    ind.classList.add('step-indicator--completed');
                }
            });

            // Update summary on step 3
            if (step === 3) {
                updateSummary();
            }

            // Scroll to top of form
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        // ─── Option Card Logic ───
        document.querySelectorAll('.option-card').forEach(function(card) {
            card.addEventListener('click', function() {
                const group = this.dataset.group;
                const value = this.dataset.value;

                document.querySelectorAll(`.option-card[data-group="${group}"]`).forEach(function(c) {
                    c.classList.remove('option-card--active');
                });
                this.classList.add('option-card--active');

                if (group === 'cohost') {
                    cohostInput.value = value;
                    calculateFee();
                } else if (group === 'category') {
                    categoryInput.value = value;
                    togglePaperTitle();
                } else if (group === 'participant_origin') {
                    originInput.value = value;
                    calculateFee();
                }
            });
        });

        function togglePaperTitle() {
            if (categoryInput.value === 'presenter') {
                paperTitleContainer.classList.remove('hidden');
                paperTitleInput.setAttribute('required', 'required');
            } else {
                paperTitleContainer.classList.add('hidden');
                paperTitleInput.removeAttribute('required');
                paperTitleInput.value = '';
            }
            calculateFee();
        }

        function calculateFee() {
            const category = categoryInput.value;
            const origin = originInput.value;
            const cohost = cohostInput.value;

            if (!category || !origin) {
                feeContainer.classList.add('hidden');
                return;
            }

            let fee = '';
            if (category === 'presenter' && origin === 'ina') {
                fee = cohost === 'yes' ? 'Rp 250.000' : 'Rp 300.000';
            } else if (category === 'presenter' && origin === 'intl') {
                fee = 'USD 25';
            } else if (category === 'non_presenter' && origin === 'ina') {
                fee = 'Rp 100.000';
            } else if (category === 'non_presenter' && origin === 'intl') {
                fee = 'USD 10';
            }

            if (fee) {
                feeAmountText.textContent = fee;
                feeContainer.classList.remove('hidden');
            } else {
                feeContainer.classList.add('hidden');
            }
        }

        // ─── File Upload UX ───
        const fileInput = document.getElementById('payment_proof');
        const uploadZone = document.getElementById('file-upload-zone');
        const fileNameDisplay = document.getElementById('file-name-display');
        const fileNameText = document.getElementById('file-name-text');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameText.textContent = this.files[0].name;
                fileNameDisplay.classList.remove('hidden');
                uploadZone.classList.add('file-upload-zone--has-file');
            } else {
                fileNameDisplay.classList.add('hidden');
                uploadZone.classList.remove('file-upload-zone--has-file');
            }
        });

        ['dragenter', 'dragover'].forEach(evt => {
            uploadZone.addEventListener(evt, e => {
                e.preventDefault();
                uploadZone.classList.add('file-upload-zone--dragover');
            });
        });
        ['dragleave', 'drop'].forEach(evt => {
            uploadZone.addEventListener(evt, e => {
                e.preventDefault();
                uploadZone.classList.remove('file-upload-zone--dragover');
            });
        });

        // ─── Summary ───
        function updateSummary() {
            const labels = {
                presenter: 'Presenter', non_presenter: 'Non-Presenter',
                ina: 'Domestic (INA)', intl: 'International',
                yes: 'Yes (Cohost)', no: 'No (Solo)'
            };
            document.getElementById('summary-category').textContent = labels[categoryInput.value] || '—';
            document.getElementById('summary-attendance').textContent = labels[cohostInput.value] || '—';
            document.getElementById('summary-origin').textContent = labels[originInput.value] || '—';
            document.getElementById('summary-fee').textContent = feeAmountText.textContent || '—';
        }

        // Init on load (for validation error repopulation)
        togglePaperTitle();
        calculateFee();

        // If there are old values (validation error), jump back to the right step with errors
        @if($errors->any())
            @if($errors->has('full_name') || $errors->has('institution') || $errors->has('country') || $errors->has('email') || $errors->has('phone'))
                goToStep(1);
            @elseif($errors->has('cohost') || $errors->has('category') || $errors->has('participant_origin') || $errors->has('paper_title'))
                goToStep(2);
            @else
                goToStep(3);
            @endif
        @endif
    });
</script>
@endpush
