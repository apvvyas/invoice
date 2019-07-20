export class sendInvoice{
	constructor(){
		this.sendMail();
		this.successNotifySendMail = new Noty({
				type: 'success',
				layout: 'topRight',
				text: 'Mail sent succesfully',
				progressBar: true,
				timeout: 2500,
				animation: {
					open: 'animated bounceInRight', // Animate.css class names
					close: 'animated bounceOutRight' // Animate.css class names
				}
			});
		this.erroNotifySendMail = new Noty({
				type: 'error',
				layout: 'topRight',
				text: 'Some error occured ..please try again later!!',
				progressBar: true,
				timeout: 2500,
				animation: {
					open: 'animated bounceInRight', // Animate.css class names
					close: 'animated bounceOutRight' // Animate.css class names
				}
			});
		$('select[name="to"]').selectpicker();
	}

	buildSendInvoice(id,recipient){
        return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-1-5x la-envelope"></i>',
                href:  'javascript:void(0)',
                title: 'View',
                class: 'ml-1 mr-1 invoice_send',
                'data-id': id || '',
                'data-recipient':recipient||''
            })).html();
    }

    initSendInvoiceEvent(isbutton){
    	var Self = this;
    	var not_button = isbutton;
    	$('#send-invoice-modal').on('shown.bs.modal',function(){
        	Self.initToggleSendTo();
        });
    	if(typeof not_button == 'undefined'){
    		$('.invoice_send').on('click',function(){
            	Self.openModal($(this));
        	});	
    	}
    	else{
    		Self.openModal(not_button);
    	}
        
        
        $('#send-invoice-modal').on('hidden.bs.modal',function(){
            $('#send_invoice')[0].reset();
            Self.setForm('','');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            if(typeof not_button != 'undefined')
            	window.location.href=route('invoices');
        })

    }

    openModal(obj){
    	this.setForm(obj.data('id'),obj.data('recipient'));
        $('#send-invoice-modal').modal('show');
    }

    setForm(id,subtext){
    	$('#send_invoice_id').val(id);
    	$('select[name="to"]').find('option[value="recipient"]').data('subtext',subtext);
    	$('select[name="to"]').selectpicker('refresh');
    }

    initToggleSendTo(){
    	let Self = this;
    	$('select[name="to"]').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    		$('#send_section').collapse('hide');
    		Self.switchToggleRequiredProp(false);
		 	$('#send_to_self_section').collapse('show');
		 	if(clickedIndex == 2){
		 		Self.switchToggleRequiredProp(true)
  				$('#send_section').collapse('show');
  				
		 	}
		 	else if(clickedIndex == 0){
		 		$('#send_to_self_section').collapse('hide');
		 	}
		})
    }

    switchToggleRequiredProp(prop){
    	$('input[name="recipient[name]"]').prop('required',prop);
		$('input[name="recipient[email]"]').prop('required',prop);
    }

    sendMail(){
    	let Self = this;
    	$('#send_invoice').on('submit',function(e){
    		e.preventDefault();
    		axios.post(route('invoice.send',$('#send_invoice_id').val()),
				new FormData($(this)[0]),
			).then(function (response) {
			    // handle success
			    Self.successNotifySendMail.setText(response.data.message,true);
			    Self.successNotifySendMail.show();
			    $('#send-invoice-modal').modal('hide');
			  })
			  .catch(function (error) {
			    // handle error
			    Self.erroNotifySendMail.show();
			    console.log(error);
			  })
			  .finally(function () {
			    // always executed
			  });
    	});
    }
}


export default sendInvoice;