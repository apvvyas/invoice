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
                    render: function(data) {


                        var tableaction = "";

                        tableaction += buildEditAction(route('product.edit',{product:data}));
                        
                        tableaction += buildDeleteAction(route('product.destroy',{product:data}))

                        return tableaction;
                    }
                }
            ],
        });


	}
}

