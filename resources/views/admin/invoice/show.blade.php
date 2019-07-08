@extends('layouts.app')

@section('content')
<div class="row"> 
	<div class="page-header">
		<div class="page-header">
			<div class="d-flex align-items-center">
			<h2 class="page-header-title">Invoice</h2>
			<div>
			<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="db-default.html"><i class="ti ti-home"></i></a></li>
			<li class="breadcrumb-item"><a href="#">Pages</a></li>
			<li class="breadcrumb-item active">Invoice</li>
			</ul>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="invoice has-shadow">

			<div class="invoice-container">

				<div class="invoice-top">
					<div class="row d-flex align-items-center">
						<div class="col-xl-6 col-md-6 col-sm-6 col-6">
							<h1>Invoice</h1>
							<span>NO. {{$invoice->title}}</span>
						</div>
						<div class="col-xl-6 col-md-6 col-sm-6 col-6 d-flex justify-content-end">
							<div class="actions dark">
								<div class="dropdown">
									<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">
										<i class="la la-ellipsis-h"></i>
									</button>
									<div class="dropdown-menu">
										<a href="" class="dropdown-item">
											<i class="la la-print"></i>Print
										</a>
										<a href="{{route('invoice.pdf',$invoice->id)}}" class="dropdown-item">
											<i class="la la-download"></i>Download PDF
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="invoice-header">
					<div class="row d-flex align-items-center">
						 <div class="col-xl-2 col-md-2 col-sm-12 d-flex justify-content-xl-start justify-content-md-center justify-content-center mb-2">
							<div class="invoice-logo">
								<img src="/img/logo.png" alt="logo">
							</div>
						</div>
						<div class="col-xl-5 col-md-5 col-sm-6 d-flex justify-content-xl-start justify-content-md-center justify-content-center mb-2">
							<div class="details">
								<ul>
									<li class="company-name">{{!empty($owner->details)?$owner->details->business_name:'-'}}</li>
									<li>{{!empty($owner->details)?$owner->details->address->address_1:'-'}}</li>
									<li>{{!empty($owner->details)?$owner->details->address->address_1:'-'}}</li>
									<li>{{!empty($owner->details)?$owner->details->address->city:'-'}},{{!empty($owner->details)?$owner->details->address->state:'-'}} {{!empty($owner->details)?$owner->details->address->postal_code:'-'}}</li>
									<li>Email: {{!empty($owner->email)?$owner->email:'-'}}</li>
									<li>Phone: {{!empty($owner->details)?$owner->details->phone:'-'}}</li>
								</ul>
							</div>
						</div>
						<div class="col-xl-5 col-md-5 col-sm-6 d-flex justify-content-xl-end justify-content-md-end justify-content-center mb-2">
							<div class="client-details">
								<ul>
									<li class="title">To.</li>
									<li>{{$invoice->recipient->name}}</li>
									<li>{{$invoice->recipient->address->address_1}}</li>
									<li>{{$invoice->recipient->address->address_2}}</li>
									<li>{{$invoice->recipient->address->city}}, {{$invoice->recipient->address->state}} {{$invoice->recipient->address->postal_code}}</li>
									<li>Phone: {{$invoice->recipient->phone}}</li>
									<li>Email: {{$invoice->recipient->email}}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="invoice-date d-flex justify-content-xl-end justify-content-center">
					<span>{{$invoice->created_at->format('F d, Y')}}</span>
				</div>

				<div class="col-xl-12 desc-tables">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-left">Item Description</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Price</th>
									<th class="text-center">Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach($invoice->items as $item)
								<tr>
									<td class="text-left">
									{{$item->item->name}}
									<br>
									<div class="description">
									{{!empty($item->item->description) ? $item->item->description : 'This is a sold product!!!'}}
									</div>
									</td>
									<td class="text-center">{{$item->quantity}}</td>
									<td class="text-center">${{$item->item->price}}</td>
									<td class="text-center">${{$item->total}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				@if(count($invoice->tax))
				<div class="col-xl-12 desc-tables">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="text-left">Tax</th>
									<th class="text-center">Percent</th>
									<th class="text-center"> </th>
									<th class="text-center">Amount</th>
								</tr>
							</thead>
							<tbody>
								@foreach($invoice->tax as $tax)
								<tr>
									<td class="text-left">
									{{$tax->name}}
									</td>
									<td class="text-center">{{$tax->percent_value}}%</td>
									<td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td class="text-center">${{$tax->value}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				@endif
			</div>


			<div class="invoice-footer">

				<div class="invoice-container">
					<div class="row d-flex align-items-center">
						<div class="col-xl-6 col-md-6 col-sm-6 d-flex justify-content-xl-start justify-content-md-start justify-content-center mb-2">
							<div class="bank">
								<div class="title">Bank Info</div>
								<div class="text">Bank Name: Bank Of America</div>
								<div class="text">Account Number: 123 456 789</div>
								<div class="text">Code: ELM0236US</div>
							</div>
						</div>
						<div class="col-xl-6 col-md-6 col-sm-6 d-flex justify-content-xl-end justify-content-md-end justify-content-center">
							<div class="total">
								<div class="title">Total</div>
								<div class="number">${{$invoice->total->total}}</div>
								<div class="taxe">Taxes Included</div>
							</div>
						</div>
					</div>
					<div class="footer-bottom">
					<div class="thx">
					<i class="la la-heart"></i><span>Thank You!</span>
					</div>
					<div class="website">www.be-elisyam.com</div>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

@stop