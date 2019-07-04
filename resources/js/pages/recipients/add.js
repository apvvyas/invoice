
$(function () {
	let recipientNew = new addRecipient();	
});

class addRecipient{

	constructor(){
		let self = this;
		this.valid = false;
		$('#add_recipient').validator().on('valid.bs.validator',function(){
			self.valid = true;
		}).on('invalid.bs.validator',function(e){
			self.valid = false;
		}).on('invalid.bs.validator',function(e){
			if(this.valid){
				self.saveRecipientDetails	
			}	
		});
		$('#add_recipient').submit(function(e){
            e.preventDefault();
            $(this).validator('validate');
        });
	}

	saveRecipientDetails(){
        let self = this;
        
        	axios.post(route('user.recipient.add'), new FormData($('#add_recipient')[0]))
        	.then(function (response) {
	            // handle success
	        	console.log(response);
	          })
	          .catch(function (error) {
	            // handle error
	            console.log(error);
	          })
	          .finally(function () {
	            // always executed
	          });	
        
        return false;
	}
}




