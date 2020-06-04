<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Notification;

class Invites extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->subject('Invitation Mail')
        ->line('Thank you for using our application!')
        ->view('emails.testmail');
    }

    // public function build()
    // {
    //     Mail::to('vrnpwr001@gmail.com')
    //     ->subject('Invitation Mail')
    //     ->send(new SendMailable('varun'));   
    //      return 'Email sent Successfully';

    //     // return $this->from(Auth::user()->email)->view('admin.team.invites.mail');
    // }
}
