<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public Participant $participant;

    /**
     * Create a new message instance.
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function build()
    {   
        $participant = $this->participant;

        if($participant->position === 'Liaison Officer'){
            return $this->markdown('emails.certificate_neo.mail')
                    ->subject('NEO 2022 - Liaison Officer Certificate')
                    ->attach(storage_path().'/app/public/LO/'.$participant->competition.'/'. $participant->name . '.pdf');
        }else{
            return $this->markdown('emails.certificate_neo.mail')
                    ->subject('NEO 2022 - Participant Certificate')
                    ->attach(storage_path().'/app/public/custom/'.$participant->competition.'/'. $participant->name . '.pdf');
        }
        
    }

    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }

}
