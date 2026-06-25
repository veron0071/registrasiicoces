<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelWriter;
use App\Mail\PaymentVerifiedMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'total' => Participant::count(),
            'presenters' => Participant::where('category', 'presenter')->count(),
            'non_presenters' => Participant::where('category', 'non_presenter')->count(),
            'domestic' => Participant::where('participant_origin', 'ina')->count(),
            'international' => Participant::where('participant_origin', 'intl')->count(),
            'verified' => Participant::where('payment_status', 'verified')->count(),
            'pending' => Participant::where('payment_status', 'pending')->count(),
            'rejected' => Participant::where('payment_status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function participants(Request $request)
    {
        $query = Participant::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('cohost')) {
            $query->where('cohost', $request->cohost);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        if ($request->filled('participant_origin')) {
            $query->where('participant_origin', $request->participant_origin);
        }
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        // Apply pagination
        $participants = $query->latest()->paginate(10)->withQueryString();

        return view('admin.participants.index', compact('participants'));
    }

    public function show(Participant $participant)
    {
        return view('admin.participants.show', compact('participant'));
    }

    public function updatePaymentStatus(Request $request, Participant $participant)
    {
        $request->validate([
            'payment_status' => 'required|in:verified,rejected',
        ]);

        $participant->update([
            'payment_status' => $request->payment_status
        ]);

        if ($request->payment_status === 'verified') {
            Mail::to($participant->email)->send(new PaymentVerifiedMail($participant));
        }

        return back()->with('success', 'Payment status updated successfully.');
    }

    public function sendZoomLink(Participant $participant)
    {
        if ($participant->payment_status !== 'verified') {
            return back()->with('error', 'Participant must have verified payment to receive Zoom link.');
        }

        try {
            Mail::to($participant->email)->send(new \App\Mail\ZoomLinkMail($participant));
            return back()->with('success', 'Zoom link sent successfully to ' . $participant->email);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send Zoom link: ' . $e->getMessage());
        }
    }

    public function sendZoomLinkToAll(Request $request)
    {
        $query = Participant::where('payment_status', 'verified');

        // Apply same filters as participants list
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('cohost')) {
            $query->where('cohost', $request->cohost);
        }
        if ($request->filled('participant_origin')) {
            $query->where('participant_origin', $request->participant_origin);
        }
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $participants = $query->get();

        if ($participants->isEmpty()) {
            return back()->with('error', 'No verified participants found to send Zoom links.');
        }

        $sentCount = 0;
        $failedCount = 0;

        foreach ($participants as $participant) {
            try {
                Mail::to($participant->email)->send(new \App\Mail\ZoomLinkMail($participant));
                $sentCount++;
            } catch (\Exception $e) {
                $failedCount++;
            }
        }

        return back()->with('success', "Zoom links sent: {$sentCount} successful, {$failedCount} failed.");
    }

    public function exportExcel(Request $request)
    {
        return $this->export($request, 'xlsx');
    }

    public function exportCsv(Request $request)
    {
        return $this->export($request, 'csv');
    }

    private function export(Request $request, $format)
    {
        $query = Participant::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('cohost')) {
            $query->where('cohost', $request->cohost);
        }
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }
        if ($request->filled('participant_origin')) {
            $query->where('participant_origin', $request->participant_origin);
        }
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        $participants = $query->lazy(); // lazy to handle large datasets

        $fileName = "participants_export.$format";

        $writer = SimpleExcelWriter::streamDownload($fileName);

        foreach ($participants as $p) {
            $writer->addRow([
                'ID' => $p->id,
                'Full Name' => $p->full_name,
                'Institution' => $p->institution,
                'Country' => $p->country,
                'Email' => $p->email,
                'Phone' => $p->phone,
                'Category' => $p->category,
                'Cohost' => $p->cohost,
                'Origin' => $p->participant_origin,
                'Fee Amount' => $p->fee_amount,
                'Fee Currency' => $p->fee_currency,
                'Payment Status' => $p->payment_status,
                'Certificate Eligible' => $p->certificate_eligible ? 'Yes' : 'No',
                'Registration Date' => $p->created_at->format('Y-m-d H:i:s'),
            ]);
        }

        $writer->toBrowser();
    }
}
