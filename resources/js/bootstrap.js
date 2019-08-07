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
                html: '<i class="la la-1-5x la-pencil"></i>',
                href: link || 'javascript:void(0)',
                title: 'Edit',
                class: ' ml-1 mr-1',
            })).html();
};

window.buildDeleteAction = function(link) {
    return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-1-5x la-trash"></i>',
                href: link || 'javascript:void(0)',
                title: 'Delete',
                class: ' ml-1 mr-1 delete-confirmation-button',
            })).html();
};

window.buildViewAction = function(link) {
   return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-1-5x la-eye"></i>',
                href: link || 'javascript:void(0)',
                title: 'View',
                class: 'ml-1 mr-1',
            })).html();
};

window.buildStatusUpdateAction = function(link) {
   return $("<div />").append(
            $('<a />', {
                html: '<i class="la la-1-5x la-upload"></i>',
                href: link || 'javascript:void(0)',
                title: 'Status',
                class: 'ml-1 mr-1',
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

window.loadershow = function(){
    $('#preloader').css('display','block');
}

window.loaderhide = function(){
    $('#preloader').css('display','none');
}

$(document).ready(function(){
    todo.list('messenger');
    $('.enter-message-form input[type="text"]').on('keypress',function(e){
        if(e.keyCode == 13){
            todo.store($(this).val());
        }
    })
    $('.send-data').on('click',function(e){
        todo.store($(this).val());
    });
    $('.todo-filter').on('click',function(){
        if(!$(this).hasClass('active')){
            $('.todo-filter.active').removeClass('active');
            $('.search-filter.active').removeClass('active');
            $('#collapseOne').collapse('hide'); 
            $(this).addClass('active');
            todo.list('messenger');
            $('.todo-title').html($(this).attr('title'));
        }
    });

    $('.search-filter').on('click',function(){
        if(!$(this).hasClass('active')){
            $('.todo-filter.active').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('#search-filter').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
              format: 'DD-MM-YYYY',
              direction: 'todo-datepicker'
        }
    });
    $('.todo-date').daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        locale: {
              format: 'DD-MM-YYYY HH:mm A',
              direction: 'todo-datepicker todo-send-date'
        }
    });

    $('#search-filter').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
        if($(this).val() != "" && $(this).val() != null){
            var start_date = moment($(this).val()+' 00:00:00','DD-MM-YYYY HH:mm:ss');
            var end_date = moment($(this).val()+' 23:59:59','DD-MM-YYYY HH:mm:ss');
            todo.list('messenger',{
                page:1,
                start_time:start_date.format('YYYY-MM-DD HH:mm:ss'),
                end_time:end_date.format('YYYY-MM-DD HH:mm:ss'),
            });
            $('.todo-title').html($(this).val());    
        }
        
    });

    $('.todo-date').on('apply.daterangepicker', function(ev, picker) {
        $('#todo-date-text').val(picker.startDate.format('DD-MM-YYYY HH:mm A'));
        if($('#todo-date-text').val() != "" && $('#todo-date-text').val() != null){
            $('#selected-todo-date').html($('#todo-date-text').val());
            $('#send-date').collapse('show');
        }
        else{
            $('#selected-todo-date').html('');
            $('#send-date').collapse('hide');   
        }
        
    });

    $(document).on('click','.checkoff',function(e){
        var parentElem = $(this).parents('[data-todo-entry]');
        todo.checkoff(parentElem);
    });
    $(document).on('click','.delete',function(e){
        var parentElem = $(this).parents('[data-todo-entry]');
        todo.delete(parentElem);
    });
});

//pageTour.pageInit();