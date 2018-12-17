<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;


    public $contact;
    
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->from($this->contact->email)
                ->markdown('emails.contact.new')
                ->subject(config('app.name').": " . $this->contact->subject);
                
    }
}
