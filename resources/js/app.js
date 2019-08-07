/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.axios = require('axios');
import Shepherd from 'shepherd.js';

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};


window.extractColumn = function (arr, column) {
  return arr.map(x => x[column])
}


window.dtable = function(identity,options){
	let tableOptions = {
			dom: 'Bfrtip',
			buttons: {
				buttons: [{
					extend: 'copy',
					text: 'Copy',
					title: $('h1').text(),
					exportOptions: {
						columns: ':not(.no-print)'
					},
					footer: true
				},{
					extend: 'excel',
					text: 'Excel',
					title: $('h1').text(),
					exportOptions: {
						columns: ':not(.no-print)'
					},
					footer: true
				},{
					extend: 'csv',
					text: 'Csv',
					title: $('h1').text(),
					exportOptions: {
						columns: ':not(.no-print)'
					},
					footer: true
				},{
					extend: 'pdf',
					text: 'Pdf',
					title: $('h1').text(),
					exportOptions: {
						columns: ':not(.no-print)'
					},
					footer: true
				},{
					extend: 'print',
					text: 'Print',
					title: $('h1').text(),
					exportOptions: {
						columns: ':not(.no-print)'
					},
					footer: true,
					autoPrint: true
				}],
				dom: {
					container: {
						className: 'dt-buttons'
					},
					button: {
						className: 'btn btn-primary'
					}
				}
			}
		};
	return $(identity).DataTable($.extend({}, tableOptions, options));
}

window.tour = new Shepherd.Tour({
  defaultStepOptions: {
    classes: 'shadow-md bg-purple-dark',
    scrollTo: true
  }
});

window.tourButtons = [
	{
		text: 'Skip',
		action: function(){

			axios.post(route('user.tour.complete')).then(function (response) {
				console.log('Tour cancelled');
			})
			.catch(function (error) {
					// handle error
					console.log(error);
			})
			.finally(function () {
					// always executed
			});
			tour.cancel();
		}
	},
	{
		text: 'Previous',
		action: tour.previous
	},
	{
			text: 'Next',
      action: tour.next
	}
];

class PageTour{

	constructor(){}

	dashboard(){
			return [
					{
							id:'invoice',
							options :{
									title: 'View All Invoices',
									text: `This naviagates to the list of your Invoices\
									Further actions will be available in this page`,
									classes:'navigate-message-left',
									tippyOptions:{
											offset:"0,370",
											interactive:true,
											placement:'left-end'
									},
									attachTo: {
										element:'#invoice',
										on: 'left'
									},
									buttons: window.tourButtons,
							}
					},
					{
							id:'recipient',
							options :{
									title: 'View All Recipients',
									text: `This naviagates to the list of your Recipients\
									Further actions will be available in this page`,
									classes:'navigate-message-left',
									tippyOptions:{
											offset:"0,370",
											interactive:true,
											placement:'left-end'
									},
									attachTo: {
										element: '#recipient',
										on: 'left'
									},
									buttons: window.tourButtons,
							}
					},
					{
							id:'product',
							options :{
									title: 'View All Products',
									text: `This naviagates to the list of your Products\
									Further actions will be available in this page`,
									classes:'navigate-message-left',
									tippyOptions:{
											offset:"0,370",
											interactive:true,
											placement:'left-end'
									},
									attachTo: {
										element: '#product',
										on: 'left'
									},
									buttons: window.tourButtons,
							}
					}
			]
	}
	
	invoice(page){

			var inner = {
					list : [],
					add  : [],
					view : [],
			};
			return inner[page];
	}

	recipients(page){
			var inner = {
					list:[],
					add:[],
			};
			return inner[page];   
	}

	products(page){
			var inner = {
					list:[],
					add:[],
			};
			return inner[page];   
	}

	pageInit(){
			var pageOpts = this.dashboard();

			$.each(pageOpts,function(key,val){
					window.tour.addStep(val.id,val.options);
			});

			window.tour.start()
	}
}

let pageTour = new PageTour();


class Todo
{
	constructor(){}

	list(id,params){
		let item = $('#'+id);
		let container = item.find('.entries');

		let data = {
			filter:$('.todo-filter.active').attr('id'),
		};
		if(typeof params != 'undefined')
			data = params;
		axios.get(item.data('url'),{params:data}).then(function (response) {

			if(typeof data.page != 'undefined' && data.page != 1)
				container.append(response.data);
			else
			{
				if(response.data.length > 0)
					container.html(response.data);
			}
		})
		.catch(function (error) {
		    // handle error
		    console.log(error);
		})
		.finally(function () {
		    // always executed
		});
	}

	store(message){
		
		if(typeof message != 'undefined' && message !== null){
			var validate = message.replace(/\s/g,'');
			var datem = moment().format('YYYY-MM-DD HH:mm:ss');

			if($('#todo-date-text').val() != null || $('#todo-date-text').val() != '')
				datem = moment($('#todo-date-text').val(),'DD-MM-YYYY HH:mm A').format('YYYY-MM-DD HH:mm:ss');

			$('#todo-date-text').val('');
			$('#selected-todo-date').html('');
            $('#send-date').collapse('hide');   

			if(validate.length > 0){
				axios.post(route('todo.save'),{message:message,scheduled_at:datem}).then(function(){
					todo.list('messenger',{page:1,filter:'today'});
					$('.enter-message-form input[type="text"]').val('');	

				}).catch(function (error) {
				    // handle error
				    console.log(error);
				})
				.finally(function () {
				    // always executed
				});	
			}
			else{
				
				$('.enter-message-form input[type="text"]').val('');	
			}
		}
		
	}

	checkoff(entryBox){
		var elem = entryBox;
		axios.post(route('todo.checkoff',{todo:elem.data('todo-entry')})).then(function(){
			var message = elem.find('strong').html();
			elem.find('strong').html("<del>"+message+"</del>");
			elem.find('.checkoff').remove();
		}).catch(function (error) {
		    // handle error
		    console.log(error);
		})
		.finally(function () {
		    // always executed
		});	
	}

	delete(entryBox){
		var elem = entryBox;
		axios.delete(route('todo.destroy',{todo:elem.data('todo-entry')})).then(function(){
			elem.remove();
		}).catch(function (error) {
		    // handle error
		    console.log(error);
		})
		.finally(function () {
		    // always executed
		});	
	}
}

window.todo = new Todo();