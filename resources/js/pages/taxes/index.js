$(function(){

	let ListTax = new listTax();
})

class listTax{
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
                    data: 'name',
                    title: "Tax Name",
                    name: 'name',
                },
                {
                    data: 'description',
                    title: "Description",
                    name: 'description',
                },
                {
                    data: 'rate',
                    title: "Rate",
                    name: 'rate',
                },
                {
                    data: 'created_at',
                    title: "Created On",
                    name: 'created_at',
                },
                {
                    data: 'id',
                    title: 'Action',
                    searchable: false,
                    sortable: false,
                    className: 'text-center text-nowrap',
                    render: function(data) {


                        var tableaction = "";

                        tableaction += buildEditAction(route('tax.edit',{tax:data}));
                        
                        tableaction += buildDeleteAction(route('tax.destroy',{tax:data}))

                        return tableaction;
                    }
                }
            ],
        });


	}
}

