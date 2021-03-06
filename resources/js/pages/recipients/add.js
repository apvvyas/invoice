
$(function () {
	let recipientNew = new addRecipient();	
});

class addRecipient{

	constructor(){
		let self = this;
		this.valid = false;
		$('#add_recipient').validator().on('valid.bs.validator',function(){
			console.log('asdasd');
			self.valid = true;
		}).on('invalid.bs.validator',function(e){
			console.log()
			self.valid = false;
		});
		$('#add_recipient').validator().on('submit', function (e) {
		  if (e.isDefaultPrevented()) {
		    $(this).validator('validate');
		  } else {
		  	$('#add_recipient button[type="submit"]').prop('disabled',true);
		  	window.loadershow();
		  	e.preventDefault();
		    self.saveRecipientDetails()
		  }
		})
	}

	saveRecipientDetails(){
        let self = this;
        
        	axios.post(route('user.recipient.add'), new FormData($('#add_recipient')[0]))
        	.then(function (response) {
        		$('#add_recipient button[type="submit"]').prop('disabled',false);
        		window.loaderhide();
	            // handle success
	        	let notifyOfRecipient = new Noty({
					type: 'success',
					layout: 'topRight',
					text: response.data,
					progressBar: true,
					timeout: 2500,
					animation: {
						open: 'animated bounceInRight', // Animate.css class names
						close: 'animated bounceOutRight' // Animate.css class names
					},
				}).on('afterClose', function() {
				    	window.location.href=route('recipients');
				}).show();
				
	          })
	          .catch(function (error) {
	          	$('#add_recipient button[type="submit"]').prop('disabled',false);
	          	window.loaderhide();
	            // handle error
	            let notifyOfRecipient = new Noty({
					type: 'error',
					layout: 'topRight',
					text: 'Select atleast one recipient',
					progressBar: true,
					timeout: 2500,
					animation: {
						open: 'animated bounceInRight', // Animate.css class names
						close: 'animated bounceOutRight' // Animate.css class names
					}
				}).show();
	            console.log(error);
	          })
	          .finally(function () {
	            // always executed
	          });	
        
        return false;
	}
}




