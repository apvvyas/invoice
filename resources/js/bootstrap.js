import validator from 'bootstrap-validator';

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
        $('.delete-confirmation-button').on('click', function(event) {
            event.preventDefault();
            var deleteUrl = $(this).attr('href');
            boot4.confirm({
                msg: "Are you sure ?",
                title: "Delete",
                callback: function(result) {
                  if(result){
                    submitDeleteResourceForm(deleteUrl)
                  }
                }
              });
        });
    };