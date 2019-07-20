<?php

namespace App\Services;

use Mail;
use App\Models\Recipient;
use App\Mail\InvoiceSend;
use Illuminate\Http\Request;
use App\Jobs\SaveAndSendInvoice;
use App\Repositories\InvoiceRepository;

class InvoiceService
{
	//Repository
	protected $repository;

	function __construct(InvoiceRepository $repo){
		$this->repository = $repo;
	}

	function getLastInsertId(){
		$invoice = $this->repository->getLastInsertedInvoice();
		$invoice_id = 0;
		if($invoice){
			$invoice_id = $invoice->id;
		}

		return $invoice_id;		
	}

	function save($data){
			

		$subtotal 	= 0;
		$tax_total  = 0;

		$invoice = $this->repository->saveInvoiceDetails([
			'invoice_id'	=> $data['invoice_id'],
			'due_date'		=> $data['due_date_set']['date'],
			'recipient_id'	=> $data['recipient_id']
		]);

		array_walk($data['lineItemSet'], function($item,$key,$invoice) use(&$subtotal){
			
			$subtotal += $this->repository->saveInvoiceItem($item,$invoice);

		}, $invoice->id);

		array_walk($data['taxItemSet'], function($item,$key,$invoice) use(&$subtotal , &$tax_total){

			$tax_amount = ($item['amount'] * $subtotal)/100;

			$tax_total += $tax_amount;

			$this->repository->saveInvoiceTax([

				'name' 			=> $item['name'],
				'percent' 		=> $item['amount'],
				'tax_in_amount'	=> $tax_amount 

			],$invoice);

		},$invoice->id);

		$this->repository->saveInvoiceTotals([
			'invoice_id' 	=> $invoice->id,
			'subtotal' 		=> $subtotal,
			'total'			=> ($subtotal + $tax_total)
		]);

		SaveAndSendInvoice::dispatch($invoice);

		return $invoice;
	}

	function updateStatus($invoice){
		return $this->repository->updateStatus($invoice);
	}

	function sendInvoice($data , $invoice){


		$invoice->subject = $data['subject'];
		if($data['to'] == 'other'){
			$recipient = new Recipient();
			$recipient->name = $data['recipient']['name'];
			$recipient->email = $data['recipient']['email'];
		}
		elseif($data['to'] == 'recipient'){
			$recipient = $invoice->recipient()->first();
			$recipient->name = $recipient->company_name;
		}
		else{
			$recipient = $invoice->owner()->first();
		}
		$mail = Mail::to($recipient);

		if(!empty($data['to_self']))
			$mail->cc($invoice->owner()->first());

		$mail->send(new InvoiceSend($invoice,$recipient));
		
		return true;
	}
}