<?php

namespace App\Mail;

use App\ClubForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class formSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ClubForm $form)
    {
      $this->form = $form;
      $this->pdf = $form->first_name . '-' . $form->last_name . '.pdf';
    }

    public function build()
    {
        return $this->view('emails.club_form')->withForm($this->form)->attach('pdf/' . $this->pdf);
    }
}
