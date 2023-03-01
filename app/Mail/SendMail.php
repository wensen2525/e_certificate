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
        // $length_name = Str::length($participant->name);
        // $pdf = Pdf::loadView('certificates.pdf',[
        //     'length_name' => $length_name,
        //     'participant' => $participant
        // ])->setPaper('a4', 'landscape');
        // dd(Storage::disk('/public/certi/')->exists($participant->name . '.pdf'));
        // $file_path = storage_path().'/app/public/certi/'. $participant->name . '.pdf';

        return $this->markdown('emails.certificate_neo.mail')
                    ->subject('NEO 2022 - Participant Certificate')
                    ->attach(storage_path().'/app/public/certi/'. $participant->name . '.pdf');
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
