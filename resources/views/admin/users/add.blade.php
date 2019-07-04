@extends('layouts.app')

@push('page-vendor-js')
    <script src="/vendors/js/bootstrap-wizard/bootstrap.wizard.min.js"></script>
	<script src="/js/components/validation/validation.min.js" type="text/javascript"></script>
@endpush

@push('snippets')

    <script src="/js/pages/user-add.js"></script>
@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Add User</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
                <a href="{{route('users')}}" class="btn btn-primary ripple">Back to Users</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
        <div class="row flex-row justify-content-center">
            <div class="col-xl-12">
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
                                        <span class="title">Personal Details</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">
                                        <span class="step">2</span>
                                        <span class="title">Business Details</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                        	<form  id="personal-details">
	                        	<div class="widget widget-19 has-border">
	                            	<div class="widget-header has-border-bottom">
										<h4>Personal Details</h4>
									</div>
	                                <div class="widget-body mt-3 mb-3">
	                                	<div class="row">
						            		<div class="col-sm-6">
						            			<div class="form-group">
								            		<label>First Name</label>
								            		<input type="text" class="form-control" name="personal[firstName]" placeholder="First Name" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								            </div>
								            <div class="col-sm-6">
						            			<div class="form-group">
								            		<label>Last Name</label>
								            		<input type="text" class="form-control" name="personal[lastName]" placeholder="Last Name" required="">
								            		<div class="help-block with-errors"></div>
								            	</div>
								            </div>
								        </div>
								        <div class="row">
								        	<div class="col-sm-6">
								        		<div class="form-group">
								            		<label>Email</label>
								            		<input type="email" class="form-control" name="personal[email]" placeholder="Email" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								        	</div>
								        	<div class="col-sm-6">
								        		<div class="form-group">
								            		<label>Phone Number</label>
								            		<input type="tel" data-minlength="10" data-maxlength="15" pattern="\d{10-15}" class="form-control" name="personal[phone]" placeholder="Phone Number" required="">
								            		<div class="help-block with-errors"></div>
								            	</div>
								        	</div>
						            	</div>
						            	<div class="row">
								        	<div class="col-sm-6">
								        		<div class="form-group">
								            		<label>Password</label>
								            		<input type="password" class="form-control" name="personal[password]" placeholder="Password" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								        	</div>
								        	<div class="col-sm-6">
								        		<div class="form-group">
								            		<label>Confirm Password</label>
								            		<input type="password" class="form-control" name="personal[passwordConf]" placeholder="Confirm Password" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								        	</div>
						            	</div>
	                                </div>
	                            </div>
	                            <ul class="pager wizard text-right">
	                                <li class="next d-inline-block">
	                                    <a href="javascript:;" class="btn btn-gradient-01">Next</a>
	                                </li>
	                            </ul>
                        	</form>
                        </div>

                        <div class="tab-pane" id="tab2">
                        	<form id="business-details">
	                        	<div class="widget widget-19 has-border">
	                            	<div class="widget-header has-border-bottom">
										<h4>Business Details</h4>
									</div>
	                                <div class="widget-body mt-3 mb-3">
	                                	<div class="row">
						            		<div class="col-sm-12">
						            			<div class="form-group">
								            		<label>Name</label>
								            		<input type="text" class="form-control" name="business[name]" placeholder="Business Name" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								            </div>
								        </div>
						            	<div class="row">
						            		<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>Apartments / Suite / Unit</label>
								            		<input type="text" class="form-control" name="business[address1]" placeholder="Apartments / Suite / Unit" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								            </div>
								        	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>Street Address</label>
								            		<input type="text" class="form-control" name="business[address2]" placeholder="Street Address" required>
								            		<div class="help-block with-errors"></div>
								            	</div>
								            </div>
								        </div>
								        <div class="row">
								        	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>City</label>
								            		<input type="text" class="form-control" name="business[city]" placeholder="City">
								            		<div class="help-block with-errors"></div>
								            	</div>
							            	</div>
								        	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>State</label>
								            		<input type="text" class="form-control" name="business[state]" placeholder="State">
								            		<div class="help-block with-errors"></div>
								            	</div>
							            	</div>
						            	</div>
						            	<div class="row">
								        	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>Country</label>
								            		<input type="text" class="form-control" name="business[country]" placeholder="Country"> 
								            		<div class="help-block with-errors"></div>
								            	</div>
							            	</div>
							            	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>Postal / Zip Code</label>
								            		<input type="text" class="form-control" name="business[postal]" placeholder="Postal / Zip Code">
								            		<div class="help-block with-errors"></div>
								            	</div>
								            </div>
								        </div>
						            	<div class="row">
								        	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>Phone</label>
								            		<input type="text" class="form-control" name="business[phone]" placeholder="Business Phone"> 
								            		<div class="help-block with-errors"></div>
								            	</div>
							            	</div>
							            	<div class="col-sm-6">
								            	<div class="form-group">
								            		<label>Tax details</label>
								            		<input type="text" class="form-control" name="business[taxDetails]" placeholder="Tax Details">
								            		<div class="help-block with-errors"></div>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop