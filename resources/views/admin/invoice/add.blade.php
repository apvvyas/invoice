@extends('layouts.app')

@push('css')

<link rel="stylesheet" href="/css/bootstrap-select/bootstrap-select.min.css">

@endpush

@push('page-vendor-js')
    <script src="/vendors/js/datepicker/moment.min.js"></script>
    <script src="/vendors/js/bootstrap-wizard/bootstrap.wizard.min.js"></script>
    <script src="/vendors/js/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/vendors/js/datepicker/daterangepicker.js"></script>
    <script src="/js/components/datepicker/datepicker.js"></script>
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
                            <div class="widget widget-19 has-border">
                            	<div class="widget-header has-border-bottom">
									<h4>Select Recipients</h4>
								</div>
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
                            <div class="widget widget-19 has-border">
								<div class="widget-header has-border-bottom">
									<h4>Set items</h4>
								</div>
                                <div class="widget-body">
                                    <form id="createItem">
                                    <div class="form-group row mb-5 bordered">
                                        
                                            <div class="col-xl-5">
                                                <input type="text" placeholder="Item or Service name" name="item_name[]" class="form-control" required="">
                                            </div>
                                            <div class="col-xl-2">
                                                <input type="text" placeholder="Quantity" name="item_quantity[]" class="form-control" required="">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon addon-primary">$</span>
                                                    <input type="text" placeholder="Price per unit" name="item_price[]" class="form-control" required="">
                                                </div>
                                            </div>
                                            <div class="col-xl-2">
                                                <button id="add_item" class="btn btn-primary ripple">Add Item</button>
                                            </div>
                                       
                                    </div>
                                    </form>
                                    <div class="mb-3">
										<ul class="item-list-total">
											<li class="item-text">											
													<div class="media row">
														<div class="col-xl-1 ">
															Sr.No.
														</div>
														<div class="col-xl-5 ">
															Item or Service Name
														</div>
														<div class="col-xl-2 ">
															Quantity
														</div>
														<div class="col-xl-4 ">
															Per unit price
														</div>
													</div>
												</li>   
        	                            
										</ul>
                                	</div>
                                	<div class="mb-3"  >
                                		<ul class="clone d-none" id="">
        		                        	<li class="list-group-item mb-2">
                                                <div class="media row">
                                                    <div class="media-left col-xl-1">
                                                        <div class="item-text" id="sr">1</div>
                                                    </div>
                                                    <div class="media-left col-xl-5">
                                                        <div class="item-text" id="item"></div>
                                                    </div>
                                                    <div class="media-body col-xl-2">
                                                        <div class="item-text" id="quantity"></div>
                                                    </div>
                                                    <div class="media-right align-self-center col-xl-4">
                                                        <div class="row">
                                                            <div class="col-sm-6 item-text" >$ <span id="per_item_cost"></span></div>
                                                            <div class="col-sm-6 text-right remove_item" id="remove_item" data-id="1">
                                                                <a class="text-danger" href="javascript:void(0);"><i class="la la-1-4x la-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
        		                        </ul>
                                        <ul id="item_list" class="list-group w-100 widget-scroll" style="max-height: 250px; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                                                
                                        </ul>
										<ul class="list-group w-100 item-list-total mt-2" tabindex="3">
											<li class="item-text">											
												<div class="media row">
													<div class="media-body col-xl-8">
														<b>Total Invoice amount: </b>
													</div>
													<div class="media-body col-xl-4">
														$<span id="amount_total">0</span>
													</div>
												</div>
											</li>      
                                        </ul>
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
                            <div class="widget widget-19 has-border">
								<div class="widget-header has-border-bottom">
									<h4>Set taxes</h4>
								</div>
                                <div class="widget-body">
                                    <form id="createTax">
                                    <div class="form-group row mb-3 bordered">
                                        
                                            <div class="col-xl-7">
                                                <input type="text" placeholder="Tax name" name="tax_name[]" class="form-control" required="">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="input-group">
                                                    
                                                    <input type="text" placeholder="Amount" name="item_quantity[]" class="form-control" required="">
                                                    <span class="input-group-addon addon-primary">%</span>
                                                </div>
                                                
                                            </div>
                                            <div class="col-xl-2">
                                                <button id="add_item" class="btn btn-primary ripple">Add Tax</button>
                                            </div>       
                                    </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12 mb-3"  >
                                            <ul class="list-group w-100 widget-scroll" style="max-height: 250px; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                                                    <li class="list-group-item">
                                                    <div class="media row">
                                                        <div class="media-left col-xl-9">
                                                            <div class="item-text"><b>Before Tax</b></div>
                                                        </div>
                                                        <div class="media-right align-self-center col-xl-3">
                                                            $<span id="before_total" class="item-text">0</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3">
										<ul class="item-list-total">
											<li class="item-text">											
													<div class="media row">
														<div class="col-xl-1 ">
															Sr.No.
														</div>
														<div class="col-xl-5 ">
															Tax Name
														</div>
														<div class="col-xl-3 ">
															Percent
														</div>
														<div class="col-xl-3 ">
															Amount
														</div>
													</div>
												</li>   
										</ul>
                                    </div>
                                    <div class="row">
                                        <div class="col-12"  >
                                            <ul class="tax-clone d-none" id="">
                                                <li class="list-group-item">
                                                    <div class="media row">
                                                        <div class="media-left col-xl-1">
                                                            <div class="item-text" id="sr">1</div>
                                                        </div>
                                                        <div class="media-left col-xl-5">
                                                            <div class="item-text" id="name"></div>
                                                        </div>
                                                        <div class="media-left col-xl-3">
                                                            <div class="item-text" ><span id="percent"></span>%</div>
                                                        </div>
                                                        <div class="media-right align-self-center col-xl-3">
                                                            <div class="row">
                                                                <div class="col-sm-6 item-text" >$<span id="amount"></span></div>
                                                                <div class="col-sm-6 text-right remove_tax" id="remove_tax" data-id="1">
                                                                    <a class="text-danger" href="javascript:void(0);"><i class="la la-trash la-1-4x"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul id="tax_list" class="list-group w-100 widget-scroll" style="max-height: 250px; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                                                    
                                            </ul>
                                        </div>

                                        <div class="mb-3 mt-3 col-12"  >
                                            <ul class="item-list-total">
                                                    <li >
                                                    <div class="media row">
                                                        <div class="media-left col-xl-9">
                                                            <b>After Tax</b>
                                                        </div>
                                                        <div class="media-right align-self-center col-xl-3">
                                                            $<span id="final_total">0</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
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
                        <div class="tab-pane" id="tab4">
							<div class="widget widget-19 has-border">
								<div class="widget-header has-border-bottom">
									<h4>Select Due Date</h4>
								</div>
                                <div class="widget-body">
									<form id="createTax">
									<div class="form-group row mb-5 bordered">
										<label class="form-control-label col-md-5 d-flex align-items-center">Invoice due duration</label>
										<div class="col-lg-7">
										<select class="selectpicker show-menu-arrow" data-style="btn-primary" id="due_date">
											<option value="-1">Select duration</option>
											<option value="1">30 days from now</option>
											<option value="2">Immediate</option>
											<option value="3">Custom date</option>
										</select>
										</div>
									</div>
									<div class="form-group row mb-5 bordered" id="custom_date">
										<label class="form-control-label col-md-5 d-flex align-items-center">Due date</label>
										<div class="col-lg-7">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="la la-calendar"></i>
													</span>
													<input type="text" class="form-control datepicker" id="invoice_date" placeholder="Select value" disabled="true">
												</div>
											</div>
										</div>
									</div>
									</form>
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
            @csrf
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