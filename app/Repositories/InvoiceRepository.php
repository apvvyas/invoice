<?php

namespace App\Repositories;

use DB;
use Auth;
use App\Models\Item;
use App\Models\Tax;
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
		if(empty($data['id'])){
			$item = Item::create([
				'user_id'	=> Auth::user()->id,
				'name'		=> $data['name'],
				'price'		=> $data['price']
			]);
		}
		else{
			$item = Item::find($data['id']);
			$tax = Tax::find($data['tax_id']);
		}

		$total = ($data['quantity']*$data['price']);
		$tax = 0; 
		if(!empty($data['tax_percent_value']))
			$tax = (($total * $data['tax_percent_value'])/100);

		$total = $total + $tax;
		InvoiceItem::create([
			'item_id'		=> $item->id,
			'invoice_id'	=> $invoice_id,
			'name'			=> $item->name,
			'price'			=> $item->price,
			'description'	=> $item->description,
			'tax_name'		=> (!empty($tax->name))?$tax->name : '',
			'tax_percent_value'		=> (!empty($tax->rate))?$tax->rate : '',
			'tax_value'		=> $tax,
			'quantity' 		=> $data['quantity'],
			'total'			=> $total
		]);

		return ($total);
		
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

	function annualInvoiceData($start_date,$end_date){
		$pending_invoices = Invoice::where(['user_id'=>Auth::user()->id])
									->whereBetween('created_at',[$start_date,$end_date])
									->pending()
									->select(
										DB::raw('status as status'),
										DB::raw('MONTHNAME(created_at) as MONTH'),
										DB::raw('YEAR(created_at) as YEAR'),
										DB::raw('COUNT(id) as INV_COUNT')
									)
									->groupBy('MONTH','status','YEAR');
		$paid_invoices = Invoice::where(['user_id'=>Auth::user()->id])
									->whereBetween('created_at',[$start_date,$end_date])
									->paid()
									->select(
										DB::raw('status as status'),
										DB::raw('MONTHNAME(created_at) as MONTH'),
										DB::raw('YEAR(created_at) as YEAR'),
										DB::raw('COUNT(id) as INV_COUNT'))
									->groupBy('MONTH','status','YEAR');



		return $paid_invoices->union($pending_invoices)->get();
	}

	function getTwoMonthsInvoiceCount($month1,$month2){
		
		$data = Invoice::where(['user_id'=>Auth::user()->id])
						->whereIn(DB::raw('MONTHNAME(created_at)'),[$month1,$month2])
						->select(DB::raw('MONTHNAME(created_at) as MONTH'),DB::raw('COUNT(id) as INV_COUNT'))
						->groupBy('MONTH')->pluck('INV_COUNT','MONTH');

		if(empty($data[$month1]))
			$data[$month1] = 0;
		if(empty($data[$month2]))
			$data[$month2] = 0;

		return $data;
	}

	function updateStatus($invoice){
		if($invoice->isPending())
			$invoice->setPaid()->update();
		elseif ($invoice->isPaid()) {
			$invoice->setPending()->update();
		}
		return $invoice;
	}


	function getRecentFiveInvoices(){
		return Invoice::with('recipient')->where(['user_id'=>Auth::user()->id])->orderBy('created_at','DESC')->paginate(5);
	}
}
