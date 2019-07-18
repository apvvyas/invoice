<?php

namespace App\Services;

use Illuminate\Http\Request;
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

		$invoice_id = $this->repository->saveInvoiceDetails([
			'invoice_id'	=> $data['invoice_id'],
			'due_date'		=> $data['due_date_set']['date'],
			'recipient_id'	=> $data['recipient_id']
		]);

		array_walk($data['lineItemSet'], function($item,$key,$invoice) use(&$subtotal){
			
			$subtotal += $this->repository->saveInvoiceItem($item,$invoice);

		}, $invoice_id);

		array_walk($data['taxItemSet'], function($item,$key,$invoice) use(&$subtotal , &$tax_total){

			$tax_amount = ($item['amount'] * $subtotal)/100;

			$tax_total += $tax_amount;

			$this->repository->saveInvoiceTax([

				'name' 			=> $item['name'],
				'percent' 		=> $item['amount'],
				'tax_in_amount'	=> $tax_amount 

			],$invoice);

		},$invoice_id);

		$this->repository->saveInvoiceTotals([
			'invoice_id' 	=> $invoice_id,
			'subtotal' 		=> $subtotal,
			'total'			=> ($subtotal + $tax_total)
		]);


		return $invoice_id;
	}

	function updateStatus($invoice){
		$this->repository->updateStatus($invoice);
	}
}