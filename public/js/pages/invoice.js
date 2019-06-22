$(function () {
		let invoiceNew = new addInvoice(invoice_id);
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
	}

	step1(){

	}

	step2(){

	}

	step3(){

	}

	fetchRecipientDetails(id){

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