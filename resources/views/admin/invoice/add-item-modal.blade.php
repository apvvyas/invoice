<div id="add-product-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <form id="add_product" role="form" method="post" data-toggle="validator">
			@csrf
            
            <div class="modal-body">
                @include('admin.products.section.add-important-fields',[
                        'required'=>[
                            'quantity'
                        ]
                    ]
                )
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
