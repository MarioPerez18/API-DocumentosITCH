<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address as MailablesAddress;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class EnviarCorreos extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $pdf_participante;
     public $body;

    public function __construct($pdf_participante, $body)
    {
        $this->pdf_participante = $pdf_participante;
        $this->body = $body;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new MailablesAddress('marioperez.photo@gmail.com', 'Luis Pérez'),
            subject: 'Documento de participación',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'correos.enviar-correo',
            with: [
                'Nombres' => $this->body['Nombres'],
                'ApellidoPaterno' => $this->body['ApellidoPaterno'],
                'ApellidoMaterno' => $this->body['ApellidoMaterno'],
                'Evento' => $this->body['Evento'],
                'TipoParticipante' => $this->body['TipoParticipante'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->pdf_participante)
            ->withMime('application/pdf')
        ];
    }
}
