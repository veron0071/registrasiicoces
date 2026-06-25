<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ZoomLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public Participant $participant;
    public string $zoomLink;
    public string $meetingId;
    public string $passcode;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
        $this->zoomLink = config('app.url') . '/zoom-info'; // atau link zoom langsung
        $this->meetingId = '123 456 7890'; // ganti dengan meeting ID yang sebenarnya
        $this->passcode = 'ICoCES2026'; // ganti dengan passcode yang sebenarnya
    }

    public function build()
    {
        return $this->subject('ICoCES 2026 - Zoom Meeting Link')
                    ->view('emails.zoom_link');
    }
}
