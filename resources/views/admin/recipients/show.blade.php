@extends('layouts.app')

@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Recipient Details</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
            	<a href="{{route('recipient.edit',['recipient'=>$recipient])}}" class="btn btn-primary ripple">Edit Recipient</a>
                <a href="{{route('recipients')}}" class="btn btn-secondary ripple">Back to Recipients</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
    	<div class="section-title mt-3 mb-3 ml-3">
    		<h4>Basic Information</h4>
    	</div>
    	<form class="form-horizontal">
    		<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Name</label>
				<div class="col-lg-6">
					<span>{{$recipient->company_name}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Email Address</label>
				<div class="col-lg-6">
					<span>{{$recipient->email}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Phone</label>
				<div class="col-lg-6">
					<span>{{$recipient->phone}}</span>
				</div>
			</div>
    	</form>
    	<div class="section-title mt-3 mb-3 ml-3">
    		<h4>Address Information</h4>
    	</div>
    	<form class="form-horizontal">
    		<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Apartments / Suite / Unit</label>
				<div class="col-lg-6">
					<span>{{$recipient->address->address_1}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Street Address</label>
				<div class="col-lg-6">
					<span>{{$recipient->address->address_2}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">City</label>
				<div class="col-lg-6">
					<span>{{$recipient->address->city}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">State</label>
				<div class="col-lg-6">
					<span>{{$recipient->address->state}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Country</label>
				<div class="col-lg-6">
					<span>{{$recipient->address->country}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Postal Code / Zip</label>
				<div class="col-lg-6">
					<span>{{$recipient->address->postal_code}}</span>
				</div>
			</div>
    	</form>
    </div>
</div>

@stop