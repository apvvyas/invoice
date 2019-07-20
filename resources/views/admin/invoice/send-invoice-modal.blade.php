<div id="send-invoice-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Send Invoice</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <form id="send_invoice" role="form" method="post" data-toggle="validator">
			@csrf
			<input type="hidden" name="invoice" value="" id="send_invoice_id">
            <div class="modal-body">
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" class="form-control" required="">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
	                <label>Send To</label>
	                <select name="to" class="form-control show-menu-arrow show-tick" required data-show-subtext="true">
	                    <option value="self">Self</option>
	                    <option value="recipient">Recipient</option>
                        <option value="other">Other</option>
	                </select>
	                <div class="help-block with-errors"></div>
	            </div>
                <div class="pt-0 collapse" id="send_to_self_section">
                    <div class="form-group ">
                        <div class="styled-checkbox">
                            <input type="checkbox" name="to_self" value="bcc_self" id="check-2">
                            <label for="check-2">Also send to self</label>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>     
                </div>
                <div class="pt-0 collapse" id="send_section">
                    <div class="form-group ">
                        <label>Recipient Name</label>
                        <input type="text" name="recipient[name]" class="form-control">
                        <div class="help-block with-errors"></div>
                    </div>    
                    <div class="form-group ">
                        <label>Recipient Email</label>
                        <input type="email" name="recipient[email]" class="form-control">
                        <div class="help-block with-errors"></div>
                    </div>    
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>
