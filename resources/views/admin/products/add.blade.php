@extends('layouts.app')

@push('css')

<link rel="stylesheet" href="/css/bootstrap-select/bootstrap-select.min.css">

@endpush

@push('page-vendor-js')
	<script src="/js/components/validation/validation.min.js" type="text/javascript"></script>
    <script src="/vendors/js/bootstrap-select/bootstrap-select.min.js"></script>
@endpush

@push('snippets')

    <script src="/js/pages/product-add.js"></script>
@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Add Product</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
                <a href="{{route('products')}}" class="btn btn-primary ripple">Back to Products</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
		<form id="add_product" action="{{route('product.save')}}" role="form" method="post" data-toggle="validator">
			@csrf
        	@include('admin.products.section.add-important-fields')
            
            <div class="row">
                <div class="col-lg-12 text-right">
                    <a href="{{url()->previous()}}" class="btn btn-shadow" data-dismiss="modal">cancel</a>
                    <button  class="btn btn-primary">Save</button>
                </div>	
            </div>
		</form>
    </div>
    
</div>


@stop