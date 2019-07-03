<?php

namespace App\Repositories;

use Auth;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\InvoiceTax;
use App\Models\InvoiceTotal;
use App\Models\InvoiceItem;
use App\Models\InvoiceRecipient;
use App\Models\RecipientAddress;

class InvoiceRepository
{
	public function getLastInsertedInvoice(){
		return Invoice::orderBy('created_at','DESC')->skip(0)->limit('1')->first();
	}

	function saveInvoiceDetails($data){

		$recipient_address = RecipientAddress::where('recipient_id', $data['recipient_id'])->firstOrFail();

		$invoice = new Invoice();

		$invoice->title 			= "Invoice#".$data['invoice_id'];
		$invoice->user_id 			= Auth::user()->id;
		$invoice->pay_address_id 	= $recipient_address->address_id;
		$invoice->bill_address_id 	= $recipient_address->address_id;
		$invoice->status 			= 'SAVED';
		$invoice->due_at 			= $data['due_date'];
		$invoice->save();

		$irecipient = new InvoiceRecipient();
		$irecipient->invoice_id 	= $invoice->id;
		$irecipient->recipient_id 	= $data['recipient_id']; 
		$irecipient->save();

		return $invoice->id;
	}

	function saveInvoiceItem($data,$invoice_id){

		$item = Item::create([
			'user_id'	=> Auth::user()->id,
			'name'		=> $data['name'],
			'price'		=> $data['price']
		]);

		InvoiceItem::create([
			'item_id'	=> $item->id,
			'invoice_id'=> $invoice_id,
			'quantity' 	=> $data['quantity'],
			'total'		=> ($data['quantity']*$data['price'])
		]);

		return ($data['quantity']*$data['price']);
		
	}

	function saveInvoiceTax($data,$invoice_id){

		$itax = new InvoiceTax();

		$itax->invoice_id = $invoice_id;
		$itax->name = $data['name'];
		$itax->percent_value = $data['percent'];
		$itax->value = $data['tax_in_amount'];

		$itax->save();

		return  $itax->id;
	}

	function saveInvoiceTotals($data){
		
		$iTotal = new InvoiceTotal();

		$iTotal->invoice_id = $data['invoice_id'];
		$iTotal->subtotal = $data['subtotal'];
		$iTotal->total = $data['total'];

		$iTotal->save();
	}
}
