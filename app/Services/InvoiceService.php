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
			$invoice_id = $invoice_id;
		}

		return $invoice_id;		
	}
}