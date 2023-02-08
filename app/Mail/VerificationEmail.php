<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email, $token, $role;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token, $role)
    {
        $this->email = $email;
        $this->token = $token;
        $this->role = $role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $param = [
            'url' => route('verify', [
                'email' => $this->email,
                'token' => $this->token 
            ]),
            'role' => $this->role,
        ];

        return $this->markdown('emails.verification')
                    ->subject('Verifikasi - MagangHub')
                    ->with('param', $param);
    }
}
