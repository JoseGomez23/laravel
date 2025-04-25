<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Usuari;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($correu)
    {
        $this->user = Usuari::getUsuari($correu);
    }

    public function build()
    {
        $resetLink = url('/pwdReset/' . $this->user->token_contrasenya);

        return $this->subject('Recuperació de contrasenya')->html("
            <html>
                <body>
                    <p>Hola {$this->user->nomusuari},</p>
                    <p>Has sol·licitat restablir la teva contrasenya.</p>
                    <p>
                        <a href=\"{$resetLink}\">Fes clic aquí per restablir-la</a>
                    </p>
                    <p>Aquest enllaç caducarà en 30 minuts.</p>
                </body>
            </html>
        ");
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password Reset Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
