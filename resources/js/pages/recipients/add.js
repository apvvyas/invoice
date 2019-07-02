
$(function () {
		let userNew = new addUser();

		$('#rootwizard .finish').click(function() {
			userNew.saveUser();
		});
});

class addUser{

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

		this.user = new FormData();
	}

	step1(){

		if ($('#personal-details')[0].checkValidity() === false) {
			$('#personal-details')[0].classList.add('was-validated');
			return false;
		}
		$('#personal-details')[0].classList.add('was-validated');
		this.captureDetails('#personal-details');
		return true;
	}

	saveUser(){
		if ($('#personal-details')[0].checkValidity() === false) {
			$('#personal-details')[0].classList.add('was-validated');
			return false;
		}

		if ($('#business-details')[0].checkValidity() === false) {
			$('#business-details')[0].classList.add('was-validated');
			return false;
		}

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

	}


	captureDetails(id){
		let data = new FormData($(id)[0]);

		for (var pair of data.entries()) {
		    this.user.append(pair[0], pair[1]);
		}
	}
}




