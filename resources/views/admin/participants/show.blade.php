@extends('layouts.admin')

@section('title', 'Participant Details - ICoCES-2026 Admin')
@section('page_title', 'Participant Details')

@section('content')

{{-- Back Button --}}
<div class="mb-6">
    <a href="{{ route('admin.participants') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-[#d90429] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Participants
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ===== Left: Participant Details ===== --}}
    <div class="lg:col-span-2">
        <div class="card card-red-top overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 bg-[#d90429]/10 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#d90429]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-base font-bold text-gray-800">Participant Details</h2>
            </div>
            <div class="divide-y divide-gray-100">
                @php
                    $rows = [
                        ['Full Name',          $participant->full_name],
                        ['Institution',        $participant->institution],
                        ['Country',            $participant->country],
                        ['Email',              $participant->email],
                        ['Phone',              $participant->phone],
                        ['Category',          ucfirst(str_replace('_', ' ', $participant->category))],
                        ['Attendance',         ucfirst($participant->attendance)],
                        ['Origin',             strtoupper($participant->participant_origin)],
                        ['Registration Date',  $participant->created_at->format('d M Y H:i')],
                    ];
                @endphp
                @foreach($rows as [$label, $value])
                <div class="flex flex-col sm:flex-row sm:items-start px-6 py-3.5 gap-0.5 sm:gap-0">
                    <span class="sm:w-44 shrink-0 text-xs sm:text-sm font-semibold text-gray-400 sm:text-gray-500 uppercase tracking-wide sm:normal-case sm:tracking-normal">{{ $label }}</span>
                    <span class="text-sm text-gray-900">{{ $value }}</span>
                </div>
                @endforeach

                @if($participant->category === 'presenter')
                <div class="flex flex-col sm:flex-row sm:items-start px-6 py-3.5 gap-0.5 sm:gap-0">
                    <span class="sm:w-44 shrink-0 text-xs sm:text-sm font-semibold text-gray-400 sm:text-gray-500 uppercase tracking-wide sm:normal-case sm:tracking-normal">Paper Title</span>
                    <span class="text-sm text-gray-900">{{ $participant->paper_title }}</span>
                </div>
                @endif

                <div class="flex flex-col sm:flex-row sm:items-center px-6 py-3.5 gap-0.5 sm:gap-0">
                    <span class="sm:w-44 shrink-0 text-xs sm:text-sm font-semibold text-gray-400 sm:text-gray-500 uppercase tracking-wide sm:normal-case sm:tracking-normal">Certificate Eligible?</span>
                    @if($participant->certificate_eligible)
                        <span class="badge-verified">Yes — Eligible</span>
                    @else
                        <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-full">Not Yet</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Right: Payment Verification ===== --}}
    <div class="lg:col-span-1">
        <div class="card overflow-hidden lg:sticky lg:top-24">

            {{-- Card Header --}}
            <div class="bg-[#111111] px-6 py-5">
                <h3 class="text-base font-bold text-white">Payment Verification</h3>
            </div>

            <div class="p-6">
                {{-- Fee Amount --}}
                <div class="text-center mb-5">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Required Amount</p>
                    <p class="text-4xl font-extrabold text-gray-900">{{ $participant->fee_currency }}</p>
                    <p class="text-2xl font-bold text-[#d90429]">{{ number_format($participant->fee_amount, 0) }}</p>
                </div>

                {{-- Current Status Badge --}}
                <div class="text-center mb-5">
                    @if($participant->payment_status == 'pending')
                        <span class="badge-pending text-sm px-4 py-1.5">⏳ Pending</span>
                    @elseif($participant->payment_status == 'verified')
                        <span class="badge-verified text-sm px-4 py-1.5">✓ Verified</span>
                    @else
                        <span class="badge-rejected text-sm px-4 py-1.5">✗ Rejected</span>
                    @endif
                </div>

                <div class="border-t border-dashed border-gray-200 my-5"></div>

                {{-- View Payment Proof --}}
                <div class="mb-5">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Payment Proof</p>
                    <a href="{{ asset('storage/' . $participant->payment_proof) }}" target="_blank"
                       class="btn-outline-primary w-full py-2.5 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Open Payment Proof
                    </a>
                </div>

                <div class="border-t border-dashed border-gray-200 my-5"></div>

                {{-- Update Status Form --}}
                <form method="POST" action="{{ route('admin.participants.update_payment', $participant->id) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="form-label">Update Status</label>
                        <select name="payment_status" class="form-select">
                            <option value="pending"   {{ $participant->payment_status === 'pending'   ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="verified"  {{ $participant->payment_status === 'verified'  ? 'selected' : '' }}>✓ Verified (Approve)</option>
                            <option value="rejected"  {{ $participant->payment_status === 'rejected'  ? 'selected' : '' }}>✗ Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-secondary w-full py-2.5 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
