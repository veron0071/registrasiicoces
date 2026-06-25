<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants,email',
            'phone' => 'required|string|min:10|max:30',
            'cohost' => 'required|in:yes,no',
            'category' => 'required|in:presenter,non_presenter',
            'participant_origin' => 'required|in:ina,intl',
            'paper_title' => 'required_if:category,presenter|nullable|string|max:255',
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $isCohost = $request->cohost === 'yes';
        $feeAmount = 0;
        $feeCurrency = 'IDR';

        if ($request->category === 'presenter') {
            if ($request->participant_origin === 'ina') {
                $feeAmount = $isCohost ? 250000 : 300000;
                $feeCurrency = 'IDR';
            } else {
                $feeAmount = 25;
                $feeCurrency = 'USD';
            }
        } else {
            if ($request->participant_origin === 'ina') {
                $feeAmount = 100000;
                $feeCurrency = 'IDR';
            } else {
                $feeAmount = 10;
                $feeCurrency = 'USD';
            }
        }

        $certificateEligible = false;

        $paymentProofPath = $request->file('payment_proof')->store('payments', 'public');

        $participant = Participant::create([
            'full_name' => $request->full_name,
            'institution' => $request->institution,
            'country' => $request->country,
            'email' => $request->email,
            'phone' => $request->phone,
            'cohost' => $request->cohost,
            'category' => $request->category,
            'participant_origin' => $request->participant_origin,
            'paper_title' => $request->category === 'presenter' ? $request->paper_title : null,
            'fee_amount' => $feeAmount,
            'fee_currency' => $feeCurrency,
            'payment_proof' => $paymentProofPath,
            'payment_status' => 'pending',
            'certificate_eligible' => $certificateEligible,
        ]);

      
        Mail::to($participant->email)->send(new WelcomeMail($participant));

        return redirect()->route('registration.success')->with([
            'success' => 'Registration submitted successfully!',
            'participant_name' => $request->full_name,
            'participant_email' => $request->email,
        ]);
    }

    public function success()
    {
        return view('registration.success');
    }
}
