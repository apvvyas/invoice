<div id="add-recipient-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<form id="add_recipient" role="form" method="post" data-toggle="validator">
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
		            		<input type="text" class="form-control" name="company_name" placeholder="Company Name / Contact Name" required>
		            		<div class="help-block with-errors"></div>
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-sm-6">
		        		<div class="form-group">
		            		<label>Email</label>
		            		<input type="email" class="form-control" required name="email" placeholder="Email">
		            		<div class="help-block with-errors"></div>
		            	</div>
		        	</div>
		        	<div class="col-sm-6">
		        		<div class="form-group">
		            		<label>Phone Number <small class="text-secondary">(numbers only, min 10-15 digits)</small></label>
		            		<input required class="form-control" name="phone" placeholder="Phone Number" type="tel" data-minlength="10" data-maxlength="15" pattern="[0-9]{10,15}" >
		            		<div class="help-block with-errors"></div>
		            	</div>
		        	</div>
            	</div>
            	<div class="row">
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Street Address</label>
		            		<input type="text" class="form-control" name="address_2" placeholder="Street Address">
		            		<div class="help-block with-errors"></div>
		            	</div>
		            </div>
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Apartments / Suite / Unit</label>
		            		<input type="text" class="form-control" name="address_1" placeholder="Apartments / Suite / Unit">
		            		<div class="help-block with-errors"></div>
		            	</div>
		            </div>
		        </div>
		        <div class="row">
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>City</label>
		            		<input type="text" class="form-control" name="city" placeholder="City">
		            		<div class="help-block with-errors"></div>
		            	</div>
	            	</div>
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>State</label>
		            		<input type="text" class="form-control" name="state" placeholder="State">
		            		<div class="help-block with-errors"></div>
		            	</div>
	            	</div>
            	</div>
            	<div class="row">
		        	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Country</label>
		            		<input type="text" class="form-control" name="country" placeholder="Country"> 
		            		<div class="help-block with-errors"></div>
		            	</div>
	            	</div>
	            	<div class="col-sm-6">
		            	<div class="form-group">
		            		<label>Postal / Zip Code <small class="text-secondary">(numbers only, 6 digits)</small></label>
		            		<input type="text" data-minlength="6" data-maxlength="6" pattern="[0-9]{6}" class="form-control" name="postal_code" placeholder="Postal / Zip Code">
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
            	
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
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