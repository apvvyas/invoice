
$(function () {
		let userEdit = new editUser();

		$('#rootwizard .finish').click(function() {
			userEdit.saveUser();
		});
});

class editUser{

	constructor(){
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
			},
			onNext(tab,navigation,index){
				if(index == 1){
					return self.step1();
				}
			}
		});	
		$('#personal-details').validator().on('invalid.bs.validator',function(e){
			self.validate = false;
		}).on('valid.bs.validator',function(){
			self.validate = true;
		});
		$('#buisness-details').validator().on('invalid.bs.validator',function(e){
			self.validate = false;
		}).on('valid.bs.validator',function(){
			self.validate = true;
		});
		this.validate = true;
		this.user = new FormData();
	}

	step1(){

		var own = this;
		
		$('#personal-details').validator('validate')

		if(this.validate){
			this.captureDetails('#personal-details');
			return true;	
		}
		return false;
	}

	saveUser(){
		var validate = true;

		$('#personal-details').validator('validate')

		$('#business-details').validator('validate')

		if(this.validate){
			this.captureDetails('#business-details');

			let data = this.user;
			axios.post(route('user.save'),data).then(function (response) {
				//window.location.href=route('users');
			})
			.catch(function (error) {
			    // handle error
			    console.log(error);
			})
			.finally(function () {
			    // always executed
			});

			return true;
		}

		return false;

	}


	captureDetails(id){
		let data = new FormData($(id)[0]);

		for (var pair of data.entries()) {
		    this.user.append(pair[0], pair[1]);
		}
	}
}




