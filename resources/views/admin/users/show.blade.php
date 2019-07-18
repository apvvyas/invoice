@extends('layouts.app')

@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>User Details</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
				@can('add_user')
				<a href="{{route('user.edit',['user'=>$user])}}" class="btn btn-primary ripple">Edit user</a>
				@endcan
                <a href="{{route('users')}}" class="btn btn-secondary ripple">Back to users</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
    	<div class="section-title mt-3 mb-3 ml-3">
    		<h4>Personal Information</h4>
    	</div>
    	<form class="form-horizontal">
    		<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Name</label>
				<div class="col-lg-6">
					<span>{{$user->name}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Email Address</label>
				<div class="col-lg-6">
					<span>{{$user->email}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Phone</label>
				<div class="col-lg-6">
					<span>{{$user->phone}}</span>
				</div>
			</div>
    	</form>
    	<div class="section-title mt-3 mb-3 ml-3">
    		<h4>Business Information</h4>
    	</div>
    	<form class="form-horizontal">
    		<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Buiness Name</label>
				<div class="col-lg-6">
					<span>{{$user->details->business_name}}</span>
				</div>
			</div>
    		<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Apartments / Suite / Unit</label>
				<div class="col-lg-6">
					<span>{{$user->details->address->address_1}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Street Address</label>
				<div class="col-lg-6">
					<span>{{$user->details->address->address_2}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">City</label>
				<div class="col-lg-6">
					<span>{{$user->details->address->city}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">State</label>
				<div class="col-lg-6">
					<span>{{$user->details->address->state}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Country</label>
				<div class="col-lg-6">
					<span>{{$user->details->address->country}}</span>
				</div>
			</div>
			<div class="form-group row d-flex align-items-center mb-5">
				<label class="col-lg-3 form-control-label d-flex justify-content-lg-end">Postal Code / Zip</label>
				<div class="col-lg-6">
					<span>{{$user->details->address->postal_code}}</span>
				</div>
			</div>
    	</form>
    </div>
</div>

@stop