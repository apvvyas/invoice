<?php

namespace App\Mail;

use PDF;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceSend extends Mailable
{
    use Queueable, SerializesModels;

    private $invoice , $recipient, $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice,$recipient)
    {
        $this->invoice = $invoice;
        $this->recipient = $recipient;
        $this->pdf = $invoice->getFirstMedia('invoice');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.mail.invoice-send')
                    ->subject($this->invoice->subject)
                    ->with([
                        'invoice'=>$this->invoice,
                        'recipient'=>$this->recipient
                    ])->attach($this->pdf->getPath(), [
                            'as' => 'invoice.pdf', 
                            'mime' => 'application/pdf',
                    ]);
    }
}
