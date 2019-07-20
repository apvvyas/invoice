<?php

namespace App\Jobs;

use PDF;
use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use App\Services\InvoiceService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SaveAndSendInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $invoice,$options;

    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    function __construct(Invoice $invoice,$options='')
    {
        $this->invoice = $invoice;
        $this->options = $options;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(InvoiceService $service)
    {
        if($this->invoice->getFirstMedia('invoice') === null){
            $path = storage_path('app/pdf/invoice_'.Carbon::now()->format('Y_m_d_H_i_s').".pdf");
            PDF::loadView('admin.invoice.export-pdf', [
                        'invoice'=>$this->invoice,
                        'owner'=>$this->invoice->owner()->first(),
                        'pdf'=>true
                ])->save($path);    
            $this->invoice->addMedia($path)->toMediaCollection('invoice');
        }
        
        if(!empty($this->options))
            $service->sendInvoice($this->options,$this->invoice);
    }
}
