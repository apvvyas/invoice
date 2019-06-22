@extends('layouts.app')

@push('page-vendor-js')
    <script src="/vendors/js/bootstrap-wizard/bootstrap.wizard.min.js"></script>
@endpush

@push('snippets')
    <script src="/js/pages/invoice.js"></script>
@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Invoice #{{$invoice_id}}</h4>
    </div>
    <div class="widget-body">
        <div class="row flex-row justify-content-center">
            <div class="col-xl-10">
                <div id="rootwizard">
                    <div class="step-container">
                        <div class="step-wizard">
                            <div class="progress">
                                <div class="progressbar"></div>
                            </div>
                            <ul>
                                <li>
                                    <a href="#tab1" data-toggle="tab">
                                        <span class="step">1</span>
                                        <span class="title">Select Recipient</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">
                                        <span class="step">2</span>
                                        <span class="title">Items</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab">
                                        <span class="step">3</span>
                                        <span class="title">Taxes</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" data-toggle="tab">
                                        <span class="step">4</span>
                                        <span class="title">Invoice Due Date</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <div class="section-title mt-5 mb-5">
                                <h4>Select Recipients</h4>
                            </div>
                            <div class="widget widget-19 has-shadow">
                            	
                                <div class="widget-body row mt-3 mb-3">
                                	<div class="col-md-6">
                                    	<div class="form-group ">
                                            <input type="text" name="company_name" class="form-control" placeholder="Company Name / Contact Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                    	<div class="form-group">    
                                            <input type="text" class="form-control" name="gst_number" placeholder="GST Number">
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="recipient_list">
                                    	
                                    </div>
                                </div>
                             </div>
                            <ul class="pager wizard text-right">
                            	<li class="d-inline-block pull-left">
                            		<button data-toggle="modal" data-target="#add-recipient-modal" class="btn btn-primary ripple">Add Recipient</button>
                            	</li>
                                <li class="previous d-inline-block">
                                    <a href="javascript:;" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="section-title mt-5 mb-5">
                                <h4>Set items</h4>
                            </div>
                            <div class="form-group row mb-3 bordered">
	                            <div class="col-xl-1 ">
	                            	<label class="form-control-label">Sr.No.</label>
	                            </div>
	                            <div class="col-xl-5 ">
	                            	<label class="form-control-label">Item or Service Name<span class="text-danger ml-2">*</span></label>
	                        	</div>
	                        	<div class="col-xl-2 ">
	                            	<label class="form-control-label">Quantity<span class="text-danger ml-2">*</span></label>
	                        	</div>
	                        	<div class="col-xl-4 ">
	                        		<label class="form-control-label">Per unit price<span class="text-danger ml-2">*</span></label>
	                        	</div>
                        	</div>
                        	<div class="mb-5 mt-5" id="item_list" >
                        		<div class="form-group row clone d-none">
		                        	<div class="col-xl-1 ">
		                        		<div class="input-group">
		                        			<span class="input-group-addon addon-primary sr">1</span>
		                        		</div>
		                        	</div>
		                            <div class="col-xl-5">
		                                <input type="text" placeholder="Item or Service name" name="item_name[]" class="form-control" required="">
		                            </div>
		                            <div class="col-xl-2">
		                                <input type="text" placeholder="Quantity" name="item_quantity[]" class="form-control" required="">
		                            </div>
		                            <div class="col-xl-4">
		                            	<div class="input-group">
		                            		<span class="input-group-addon addon-primary">$</span>
		                            		<input type="text" placeholder="Price per unit" name="item_price[]" class="form-control" required="">
		                            	</div>
		                            </div>
		                        </div>
                        		<div class="form-group row">
		                        	<div class="col-xl-1 ">
		                        		<div class="input-group">
		                        			<span class="input-group-addon addon-primary">1</span>
		                        		</div>
		                        	</div>
		                            <div class="col-xl-5">
		                                <input type="text" placeholder="Item or Service name" name="item_name[]" class="form-control" required="">
		                            </div>
		                            <div class="col-xl-2">
		                                <input type="text" placeholder="Quantity" name="item_quantity[]" class="form-control" required="">
		                            </div>
		                            <div class="col-xl-4">
		                            	<div class="input-group">
		                            		<span class="input-group-addon addon-primary">$</span>
		                            		<input type="text" placeholder="Price per unit" name="item_price[]" class="form-control" required="">
		                            	</div>
		                            </div>
		                        </div>
                        	</div>
                            
                            <ul class="pager wizard text-right">
                            	<li class="d-inline-block pull-left">
                            		<button id="add_item" type="button" class="btn btn-primary ripple">Add Item</button>
                            	</li>
                                <li class="previous d-inline-block">
                                    <a href="javascript:;" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <div class="section-title mt-5 mb-5">
                                <h4>Confirmation</h4>
                            </div>
                            <div id="accordion-icon-right" class="accordion">
                                <div class="widget has-shadow">
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseOne" aria-expanded="true">
                                        <div class="card-title w-100">1. Client Informations</div>
                                    </a>
                                    <div id="IconRightCollapseOne" class="card-body collapse show" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Name</div>
                                            <div class="col-sm-8 form-control-plaintext">David Green</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Email</div>
                                            <div class="col-sm-8 form-control-plaintext">dgreen@elisyam.com</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Phone</div>
                                            <div class="col-sm-8 form-control-plaintext">+00 987 654 32</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Occupation</div>
                                            <div class="col-sm-8 form-control-plaintext">UX Designer</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseTwo">
                                        <div class="card-title w-100">2. Address</div>
                                    </a>
                                    <div id="IconRightCollapseTwo" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Address</div>
                                            <div class="col-sm-8 form-control-plaintext">123 Century Blvd</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Country</div>
                                            <div class="col-sm-8 form-control-plaintext">Country</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">City</div>
                                            <div class="col-sm-8 form-control-plaintext">Los Angeles</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">State</div>
                                            <div class="col-sm-8 form-control-plaintext">CA</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Zip</div>
                                            <div class="col-sm-8 form-control-plaintext">90045</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseThree">
                                        <div class="card-title w-100">3. Account Details</div>
                                    </a>
                                    <div id="IconRightCollapseThree" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Username</div>
                                            <div class="col-sm-8 form-control-plaintext">Saerox</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Password</div>
                                            <div class="col-sm-8 form-control-plaintext"><span class="la-2x">*********</span></div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Url</div>
                                            <div class="col-sm-8 form-control-plaintext">http://mywebsite.com</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseFour">
                                        <div class="card-title w-100">4. Billing Information</div>
                                    </a>
                                    <div id="IconRightCollapseFour" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Card Number</div>
                                            <div class="col-sm-8 form-control-plaintext">98765432145698547</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Month</div>
                                            <div class="col-sm-8 form-control-plaintext">06</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Year</div>
                                            <div class="col-sm-8 form-control-plaintext">2023</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">CVV</div>
                                            <div class="col-sm-8 form-control-plaintext">651</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-xl-12">
                                                <div class="styled-checkbox">
                                                    <input type="checkbox" name="checkbox" id="agree">
                                                    <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard text-right">
                                <li class="previous d-inline-block">
                                    <a href="javascript:void(0)" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:void(0)" class="finish btn btn-gradient-01" data-toggle="modal">Finish</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <div class="section-title mt-5 mb-5">
                                <h4>Confirmation</h4>
                            </div>
                            <div id="accordion-icon-right" class="accordion">
                                <div class="widget has-shadow">
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseOne" aria-expanded="true">
                                        <div class="card-title w-100">1. Client Informations</div>
                                    </a>
                                    <div id="IconRightCollapseOne" class="card-body collapse show" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Name</div>
                                            <div class="col-sm-8 form-control-plaintext">David Green</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Email</div>
                                            <div class="col-sm-8 form-control-plaintext">dgreen@elisyam.com</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Phone</div>
                                            <div class="col-sm-8 form-control-plaintext">+00 987 654 32</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Occupation</div>
                                            <div class="col-sm-8 form-control-plaintext">UX Designer</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseTwo">
                                        <div class="card-title w-100">2. Address</div>
                                    </a>
                                    <div id="IconRightCollapseTwo" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Address</div>
                                            <div class="col-sm-8 form-control-plaintext">123 Century Blvd</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Country</div>
                                            <div class="col-sm-8 form-control-plaintext">Country</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">City</div>
                                            <div class="col-sm-8 form-control-plaintext">Los Angeles</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">State</div>
                                            <div class="col-sm-8 form-control-plaintext">CA</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Zip</div>
                                            <div class="col-sm-8 form-control-plaintext">90045</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseThree">
                                        <div class="card-title w-100">3. Account Details</div>
                                    </a>
                                    <div id="IconRightCollapseThree" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Username</div>
                                            <div class="col-sm-8 form-control-plaintext">Saerox</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Password</div>
                                            <div class="col-sm-8 form-control-plaintext"><span class="la-2x">*********</span></div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Url</div>
                                            <div class="col-sm-8 form-control-plaintext">http://mywebsite.com</div>
                                        </div>
                                    </div>
                                    <a class="card-header collapsed d-flex align-items-center" data-toggle="collapse" href="#IconRightCollapseFour">
                                        <div class="card-title w-100">4. Billing Information</div>
                                    </a>
                                    <div id="IconRightCollapseFour" class="card-body collapse" data-parent="#accordion-icon-right">
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Card Number</div>
                                            <div class="col-sm-8 form-control-plaintext">98765432145698547</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Month</div>
                                            <div class="col-sm-8 form-control-plaintext">06</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">Exp Year</div>
                                            <div class="col-sm-8 form-control-plaintext">2023</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-3 form-control-label d-flex align-items-center">CVV</div>
                                            <div class="col-sm-8 form-control-plaintext">651</div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <div class="col-xl-12">
                                                <div class="styled-checkbox">
                                                    <input type="checkbox" name="checkbox" id="agree">
                                                    <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard text-right">
                                <li class="previous d-inline-block">
                                    <a href="javascript:void(0)" class="btn btn-secondary ripple">Previous</a>
                                </li>
                                <li class="next d-inline-block">
                                    <a href="javascript:void(0)" class="finish btn btn-gradient-01" data-toggle="modal">Finish</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop



@push('modal')
<div id="add-recipient-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form id="add_recipient" role="form" method="post">
        	<div class="modal-header">
                <h4 class="modal-title">Add Recipient</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row">
            		<div class="col-sm-12">
            			<div class="form-group">
		            		<label>Company Name / Contact Name</label>
		            		<input type="text" class="form-control" name="company_name" placeholder="Company Name / Contact Name">
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-sm-6">
		        		<div class="form-group">
		            		<label>Email</label>
		            		<input type="email" class="form-control" name="email" placeholder="Email">
		            	</div>
		        	</div>
		        	<div class="col-sm-6">
		        		<div class="form-group">
		            		<label>Phone Number</label>
		            		<input type="text" class="form-control" name="phone" placeholder="Phone Number">
		            	</div>
		        	</div>
            	</div>
            	<div class="row">
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Street Address</label>
		            		<input type="text" class="form-control" name="address_2" placeholder="Street Address">
		            	</div>
		            </div>
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Apartments / Suite / Unit</label>
		            		<input type="text" class="form-control" name="address_1" placeholder="Apartments / Suite / Unit">
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>City</label>
		            		<input type="text" class="form-control" name="city" placeholder="City">
		            	</div>
	            	</div>
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>State</label>
		            		<input type="text" class="form-control" name="state" placeholder="State">
		            	</div>
	            	</div>
            	</div>
            	<div class="row">
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Country</label>
		            		<input type="text" class="form-control" name="country" placeholder="Country"> 
		            	</div>
	            	</div>
	            	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Postal / Zip Code</label>
		            		<input type="text" class="form-control" name="postal_code" placeholder="Postal / Zip Code">
		            	</div>
		            </div>
		        </div>
            	<div class="row">
		        	<div class="col-sm-12">
		            	<div class="form-group">
		            		<label>Message</label>
		            		<textarea class="form-control" name="message" placeholder="Message"></textarea>
		            	</div>
            		</div>
            	</div>
            	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>	

<div id="success-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="sa-icon sa-success animate" style="display: block;">
                    <span class="sa-line sa-tip animateSuccessTip"></span>
                    <span class="sa-line sa-long animateSuccessLong"></span>
                    <div class="sa-placeholder"></div>
                    <div class="sa-fix"></div>
                </div>
                <div class="section-title mt-5 mb-2">
                    <h2 class="text-gradient-02">Thank you!</h2>
                </div>
                <p class="mb-5">The form was submitted successfully</p>
                <button type="button" class="btn btn-shadow mb-3" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

@endpush