$(function(){

	let ListProduct = new listProduct();
})

class listProduct{
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
                    title: "Product Name",
                    name: 'name',
                },
                {
                    data: 'quantity',
                    title: "Quantity",
                    name: 'quantity',
                },
                {
                    data: 'price',
                    title: "Price",
                    name: 'price',
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
                    render: function(data,type,row) {


                        var tableaction = "";

                        if(row.permissions.edit !== false)
                            tableaction += buildEditAction(route('product.edit',{product:data}));
                        if(row.permissions.view !== false)
                            tableaction += buildViewAction(route('product.show',{product:data}));
                        if(row.permissions.delete !== false)
                            tableaction += buildDeleteAction(route('product.destroy',{product:data}))

                        if(tableaction == "")
                            tableaction = "-";
                        return tableaction;
                    }
                }
            ],
        });


	}
}

