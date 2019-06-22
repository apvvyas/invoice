<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceRepository
{
	public function getLastInsertedInvoice(){
		return Invoice::orderBy('created_at','DESC')->skip(0)->limit('1')->get();
	}
}
