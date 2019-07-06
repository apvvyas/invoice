/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.axios = require('axios');
/*require('./bootstrap');*/
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