$(function () {
		let invoiceNew = new addInvoice(invoice_id);
		invoiceNew.fetchRecipientList();
		$('#add-recipient-modal').on('shown.bs.modal',function(){
			$('#add_recipient').submit(function(e){
				e.preventDefault();
				invoiceNew.saveRecipientDetails();
				
			});	
		})
		$('#add-recipient-modal').on('hidden.bs.modal',function(){
			$('#add_recipient')[0].reset();
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
		});
		$('input[name="company_name"] , input[name="gst_number"]').on('keyup',function(e){
			if(e.keyCode == 13){
				invoiceNew.fetchRecipientList();
			}
		});
		$('#add_item').on('click',function(){
			invoiceNew.createItem();
		})
		
});


class addInvoice{

	constructor(id){
		var self = this;
		this.wizard = $('#rootwizard').bootstrapWizard({
			onInit:function(tab,navigation,index){
				var $total = navigation.find('li').length;	
				var width = ((100/$total))+'%';
				navigation.find('li').each(function(){
					$(this).css({'width':width});
				})
			},
			onTabShow: function (tab, navigation, index) {
				var $total = navigation.find('li').length;
				var $current = index + 1;
				var $percent = ($current / $total) * 100;
				$('#rootwizard .progressbar').css({
					width: $percent + '%'
				});
			},
			onTabClick(tab,navigation,index){
				return false;
			}
		});	
		this.invoice = new Invoice(id);
		this.itemCount = 1;
	}

	step1(){

	}

	step2(){

	}

	step3(){

	}

	fetchRecipientDetails(id){

	}

	saveRecipientDetails(){
		let self = this;
		axios.post(route('user_recipient_add'),
			new FormData($('#add_recipient')[0]),
		).then(function (response) {
		    // handle success
		    self.fetchRecipientList();
		    $('#add-recipient-modal').modal('hide');
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

	fetchRecipientList(){
		axios.get(route('user_recipient_list'),{
			params:{
				company_name:$('input[name="company_name"]').val(),
				gst_number:$('input[name="gst_number"]').val(),
				page:0,
				limit:10
			}
		}).then(function (response) {
		    // handle success
		    $('#recipient_list').html(response.data.html);
		    $('.checkbox').click(function(){
		    	var current_id = $(this).attr('id');
		    	$('.checkbox').each(function(){
		    		if($(this).attr('id') == current_id){
		    			$(this).addClass('is-checked');	
		    			$('#check_'+current_id).prop('checked',true);
		    		}
		    		else{
		    			$(this).removeClass('is-checked');
		    		}
		    	})
        		
    		});
		    
		  })
		  .catch(function (error) {
		    // handle error
		    console.log(error);
		  })
		  .finally(function () {
		    // always executed
		  });

	}

	createItem(){
		let cloneItem = $('#item_list .clone').clone();
		let itemCount = this.itemCount;
		cloneItem.find('.sr').html(itemCount+1);
		$('<div/>', {
    		"class": "form-group row",
		}).html(cloneItem.html()).appendTo('#item_list');
		this.itemCount = this.itemCount + 1;
	}

}


class Invoice{

	constructor(id){
		this.invoice_id = id
	}

	set recipient(recipient){

	}

	set tax(tax){

	}

	set lineItems(lineItems){

	}

	set basic(basic){

	}
}