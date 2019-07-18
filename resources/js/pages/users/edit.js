$(function () {
		window.userEdit = new editUser();

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
				if(!profile)
					return false;
			},
			onNext(tab,navigation,index){
				if(index == 1){
					return self.step1() ;
				}
			}
		});
		
		this.validate = false;
		this.validation = {
			personal:[],
			business:[]
		};	
		this.user = new FormData();

		this.initPersonalValidate();
		this.initBusinessValidate();

		if(profile)
			this.initMediaUpload();
	}

	initPersonalValidate(){
		var self = this;
		$('#personal-details').validator().on('invalid.bs.validator',function(e){
			self.validation['personal'].push(e.relatedTarget.name);
			self.validate = false;
		}).on('valid.bs.validator',function(e){
			var index = self.validation['personal'].indexOf(e.relatedTarget.name);
			if (index > -1) {
				self.validation['personal'].splice(index,1);
			}
		}).on('validated.bs.validator',function(){
				if(self.validation['personal'].length == 0)
					self.validate = true;
		});
	}

	initBusinessValidate(){
		var self = this;
		$('#business-details').validator().on('invalid.bs.validator',function(e){
			self.validation['business'].push(e.relatedTarget.name);
			self.validate = false;
		}).on('valid.bs.validator',function(e){
			var index = self.validation['personal'].indexOf(e.relatedTarget.name);
			if (index > -1) {
				self.validation['personal'].splice(index,1);
			}
		}).on('validated.bs.validator',function(){
				if(self.validation['business'].length == 0)
					self.validate = true;
		});
	}

	initMediaUpload(){
		$('#file_upload').on('click',function(){
			$('input[name="logo"]').trigger('click');
		});
		$('input[name="logo"]').on('change',this.handleFileSelect);
	}

	handleFileSelect(evt) {
		
	    var files = evt.target.files; // FileList object

	    // Loop through the FileList and render image files as thumbnails.
	    var f = files[0];
	    console.log(f);
	      // Only process image files.
	      if (f.type.match('image.*')) {
	      		var reader = new FileReader();

		      	// Closure to capture the file information.
		      	reader.onload = (function(theFile) {
		        	return function(e) {
		        		console.log(e.target.result);
		          	// Render thumbnail.
		          	$('.img-company-logo').css('background-image','url('+e.target.result+')');
		        	};
		      	})(f);

		     	// Read in the image file as a data URL.
		      	reader.readAsDataURL(f);  
	      }

	      userEdit.captureDetails('#media-details');
	    
	 }


	step1(){

		var own = this;
		$('#personal-details').validator('validate');
		if(this.validate){
			//this.captureDetails('#personal-details');
			return true;	
		}
		return false;
	}

	saveUser(){
		var validate = true;

		$('#personal-details').validator('validate');

		$('#business-details').validator('validate');

		if(this.validate){
			this.captureDetails('#personal-details');
			this.captureDetails('#business-details');


			let data = this.user;
			let ajaxRoute = route('user.update',{user:user_id});
			if(route().current("user.profile"))
				ajaxRoute = route('user.profile.save');
			
			axios.post(ajaxRoute,data,{
		        headers: {
		          'Content-Type': 'multipart/form-data'
		        }
		    }).then(function (response) {

				if(route().current("user.profile")){
					new Noty({
						type: 'success',
						layout: 'topRight',
						text: 'Profile Updated Successfully',
						progressBar: true,
						timeout: 2500,
						animation: {
							open: 'animated bounceInRight', // Animate.css class names
							close: 'animated bounceOutRight' // Animate.css class names
						}
					}).show();
				}
				else{
					window.location.href=route('users');	
				}
				//
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




