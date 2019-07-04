@extends('layouts.app')

@push('page-vendor-js')
	<script src="/js/components/validation/validation.min.js" type="text/javascript"></script>
@endpush

@push('snippets')

    <script src="/js/pages/recipient-add.js"></script>
@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Add Recipient</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
                <a href="{{route('recipients')}}" class="btn btn-primary ripple">Back to Recipients</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
        <form id="add_recipient" role="form" method="post">
            @csrf
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="form-group">
	            		<label>Company Name / Contact Name</label>
	            		<input type="text" class="form-control" name="company_name" placeholder="Company Name / Contact Name" required>
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col-sm-6">
	        		<div class="form-group">
	            		<label>Email</label>
	            		<input type="email" class="form-control" name="email" placeholder="Email" required>
	            		<div class="help-block with-errors"></div>
	            	</div>
	        	</div>
	        	<div class="col-sm-6">
	        		<div class="form-group">
	            		<label>Phone Number <span class="text-secondary">(numbers only)</span></label>
	            		<input type="tel" data-minlength="10" data-maxlength="15" pattern="[0-9]{10,15}" class="form-control" name="phone" placeholder="Phone Number"  data-validation="number" required>
	            		<div class="help-block with-errors"></div>
	            	</div>
	        	</div>
        	</div>
        	<div class="row">
	        	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>Street Address</label>
	            		<input type="text" class="form-control" name="address_2" placeholder="Street Address" >
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>Apartments / Suite / Unit</label>
	            		<input type="text" class="form-control" name="address_1" placeholder="Apartments / Suite / Unit" >
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>City</label>
	            		<input type="text" class="form-control" name="city" placeholder="City" >
	            		<div class="help-block with-errors"></div>
	            	</div>
            	</div>
	        	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>State</label>
	            		<input type="text" class="form-control" name="state" placeholder="State" >
	            		<div class="help-block with-errors"></div>
	            	</div>
            	</div>
        	</div>
        	<div class="row">
	        	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>Country</label>
	            		<input type="text" class="form-control" name="country" placeholder="Country" > 
	            		<div class="help-block with-errors"></div>
	            	</div>
            	</div>
            	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>Postal / Zip Code</label>
	            		<input type="text" class="form-control" name="postal_code" placeholder="Postal / Zip Code" >
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        </div>
        	<div class="row">
	        	<div class="col-sm-12">
	            	<div class="form-group">
	            		<label>Message</label>
	            		<textarea class="form-control" name="message" placeholder="Message"></textarea>
	            		<div class="help-block with-errors"></div>
	            	</div>
        		</div>
        	</div>
        	<div class="row">
        		<div class="col-lg-12 text-right">
	        		<a href="{{url()->previous()}}" class="btn btn-shadow" data-dismiss="modal">cancel</a>
	            	<button  class="btn btn-primary">Save</button>
            	</div>	
        	</div>
        	
        </form>
    </div>
    
</div>


@stop