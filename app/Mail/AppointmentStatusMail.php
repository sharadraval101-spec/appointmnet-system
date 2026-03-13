<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $messageText;

    public function __construct(Appointment $appointment, string $messageText)
    {
        $this->appointment = $appointment;
        $this->messageText = $messageText;
    }

    public function build()
    {
        return $this->subject('Appointment Status Update')
                    ->view('emails.appointment_status');
    }
}
