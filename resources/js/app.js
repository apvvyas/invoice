/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};
//require('jquery-serializejson');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


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


var submitDeleteResourceForm = function(deleteUrl) {
    $('<form>', {
        'method': 'POST',
        'action': deleteUrl,
        'target': '_top'
    })
    .append($('<input>', {
        'name': '_token',
        'value': $('meta[name="csrf-token"]').attr('content'),
        'type': 'hidden'
    }))
    .append($('<input>', {
        'name': '_method',
        'value': 'DELETE',
        'type': 'hidden'
    }))
    .hide().appendTo("body").submit();
};

window.buildEditAction = function(link) {
    return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-pencil"></i>',
                href: link || 'javascript:void(0)',
                title: 'Edit',
                class: 'btn btn-md btn-round-sm btn-info ml-1 mr-1',
            })).html();
};

window.buildDeleteAction = function(link) {
    return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-trash"></i>',
                href: link || 'javascript:void(0)',
                title: 'Delete',
                class: 'btn btn-md btn-round-sm btn-danger ml-1 mr-1 delete-confirmation-button',
            })).html();
};

window.buildViewAction = function(link) {
   return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-eye"></i>',
                href: link || 'javascript:void(0)',
                title: 'View',
                class: 'btn btn-md btn-round-sm btn-info ml-1 mr-1',
            })).html();
};

window.initConfirmationOnDelete = function() {
        $('body').on('click', '.delete-confirmation-button', function(event) {
            event.preventDefault();
            var deleteUrl = $(this).attr('href');
                if (confirm('Are you sure you want to delete ? ')) {
                    submitDeleteResourceForm(deleteUrl);
                }
        });
    };