@extends('layouts.admin')

@section('title', 'Admin Login - ICoCES-2026')
@section('page_title', 'Login')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="w-full max-w-sm">

        {{-- Logo & Title --}}
        <div class="text-center mb-8">
            <div class="inline-flex w-16 h-16 bg-[#d90429] rounded-2xl items-center justify-center shadow-lg shadow-[#d90429]/30 mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900">Admin Login</h1>
            <p class="text-gray-500 text-sm mt-1">ICoCES-2026 Management System</p>
        </div>

        {{-- Error Alert --}}
        @if($errors->any())
            <div class="alert-error mb-5">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Login Card --}}
        <div class="card card-red-top px-8 py-8">
            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" name="username"
                           class="form-input" placeholder="Enter username"
                           autocomplete="off" required autofocus>
                </div>

                <div class="mb-6">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password"
                           class="form-input" placeholder="••••••••"
                           required>
                </div>

                <button type="submit" class="btn-primary w-full py-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            &copy; {{ date('Y') }} ICoCES-2026. Restricted access.
        </p>

    </div>
</div>
@endsection
