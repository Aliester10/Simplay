<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CareerApplication;
use App\Models\CareerPosition;

class CareerApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $position;

    /**
     * Create a new message instance.
     */
    public function __construct(CareerApplication $application, CareerPosition $position)
    {
        $this->application = $application;
        $this->position = $position;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Lamaran Baru: ' . $this->application->name)
                    ->markdown('emails.career.application')
                    ->attach(public_path($this->application->cv_path)); // CV terlampir
    }
}
