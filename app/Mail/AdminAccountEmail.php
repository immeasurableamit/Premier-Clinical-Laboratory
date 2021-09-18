<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAccountEmail extends Mailable
{
    public $data;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.site-admin.account-email')
            ->with([
                'url' => $this->data['url'],
                'email' => $this->data['email'],
                'password' => $this->data['password'],
            ]);
    }
}
