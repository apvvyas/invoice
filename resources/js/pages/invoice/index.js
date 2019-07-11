$(function(){

	let ListInvoice = new listInvoice();
})

class listInvoice{
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
                    data: 'title',
                    title: 'Invoice Title',
                    name: 'title',
                },
                {
                    data: 'recipient',
                    title: "Recipient",
                    name: 'recipient',
                },
                {
                    data: 'status',
                    title: "Status",
                    name: 'status',
                    render : function(data,row){
                    	let status = $('<span/>', {
						    id: 'status'+row.id,
						    "class": 'text text-'+data.color,
						    title: data.text
						}).html(data.text);

						let div = $('<div/>').html(status);

						return div.html();
                    }
                },
                {
                    data: 'due_at',
                    title: 'Due Date',
                    name: 'due_at'
                },
                {
                    data: 'id',
                    title: 'Action',
                    searchable: false,
                    sortable: false,
                    className: 'text-center text-nowrap',
                    render: function(data,type,row) {

                        
                        var tableaction = "";
                        
                        if(row.permissions.view !== false)
                            tableaction += buildViewAction(route('invoice.show',{invoice:data}));
                        
                        if(row.permissions.delete !== false)
                            tableaction += buildDeleteAction(route('invoice.destroy',{invoice:data}))

                        return tableaction;
                    }
                }
            ],
        });
	}
}

