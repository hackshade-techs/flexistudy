<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }
    
    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
            'g-recaptcha-response' => 'required_if:captcha_status,true|captcha',
        ]);
        $contact = new Contact();
        $contact->body = $request->body;
        $contact->subject = $request->subject;
        $contact->name = $request->name;
        $contact->email = $request->email;
        
        Mail::to(config('settings.contact_email'))->send(new ContactMessage($contact));
        
        return redirect()->back()->withFlashSuccess(trans('strings.frontend.message-sent'));

    }
}
