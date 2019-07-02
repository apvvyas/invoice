$(function(){

	let ListRecipient = new listRecipient();

    $('#add-recipient-modal').on('show.bs.modal',function(){
        $('#add_recipient').submit(function(e){
            e.preventDefault();
            ListRecipient.saveRecipientDetails();
        }); 
    })
    $('#add-recipient-modal').on('hidden.bs.modal',function(){
        $('#add_recipient')[0].reset();
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

})

class listRecipient{
	constructor(){
		this.dtable = dtable('#export-table',{
			fnDrawCallback:function(){
				initConfirmationOnDelete()
			},
            ajax: {
                url: $('table#export-table').data('url'),
                method: 'get',
            },
            columns: [
                {
                    data: 'company_name',
                    title: "Company",
                    name: 'company_name',
                },
                {
                    data: 'phone',
                    title: "Phone",
                    name: 'phone',
                },
                {
                    data: 'email',
                    title: "Email",
                    name: 'email',
                },
                {
                    data: 'id',
                    title: 'Action',
                    searchable: false,
                    sortable: false,
                    className: 'text-center text-nowrap',
                    render: function(data) {


                        var tableaction = "";

                        tableaction += buildEditAction(route('recipient.edit',{recipient:data}));
                        
                        tableaction += buildViewAction(route('recipient.show',{recipient:data}));
                        
                        tableaction += buildDeleteAction(route('recipient.destroy',{recipient:data}))

                        return tableaction;
                    }
                }
            ],
        });


	}

    saveRecipientDetails(){
        let self = this;
        axios.post(route('user.recipient.add'),
            new FormData($('#add_recipient')[0]),
        ).then(function (response) {
            // handle success
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
}

