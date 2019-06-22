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
                            	<div class="widget-header bordered d-flex align-items-center row">
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
                                </div>
                                <div class="widget-body p-0 row mt-3 mb-3">
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
                                <h4>Account Details</h4>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-6 mb-3">
                                    <label class="form-control-label">Username<span class="text-danger ml-2">*</span></label>
                                    <input type="text" value="DGreen" class="form-control">
                                </div>
                                <div class="col-xl-6">
                                    <label class="form-control-label">Password<span class="text-danger ml-2">*</span></label>
                                    <input type="text" value="**********" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12">
                                    <label class="form-control-label">Url</label>
                                    <input type="url" value="http://mywebsite.com" class="form-control">
                                </div>
                            </div>
                            <div class="section-title mt-5 mb-5">
                                <h4>Billing Information</h4>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-control-label">Card Number</label>
                                    <input type="text" value="98765432145698547" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-4 mb-3">
                                    <label class="form-control-label">Exp Month<span class="text-danger ml-2">*</span></label>
                                    <select name="exp-month" class="custom-select form-control">
                                        <option value="">Select</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06" selected>06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-xl-4 mb-3">
                                    <label class="form-control-label">Exp Year<span class="text-danger ml-2">*</span></label>
                                    <select name="exp-month" class="custom-select form-control">
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023" selected>2023</option>
                                        <option value="2024">2024</option>
                                    </select>
                                </div>
                                <div class="col-xl-4">
                                    <label class="form-control-label">CVV<span class="text-danger ml-2">*</span></label>
                                    <input type="email" value="651" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-xl-12">
                                    <div class="styled-checkbox">
                                        <input type="checkbox" name="savecard" id="check-card">
                                        <label for="check-card">Save this card</label>
                                    </div>
                                </div>
                            </div>
                            <ul class="pager wizard text-right">
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
        	<form>
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
		            		<input type="text" class="form-control" name="contact_name" placeholder="Company Name / Contact Name">
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
		            		<input type="text" class="form-control" name="address_2" placeholder="Apartments / Suite / Unit">
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
                <button type="button" class="btn btn-primary">Save</button>
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