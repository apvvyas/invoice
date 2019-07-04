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