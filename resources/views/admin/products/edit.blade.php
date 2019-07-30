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
        <h2>Edit Product</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
                <a href="{{route('products')}}" class="btn btn-primary ripple">Back to Products</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
        <form id="add_product" action="{{route('product.update',['product'=>$product])}}" role="form" method="post" data-toggle="validator">
            @csrf
        	<div class="row">
        		<div class="col-sm-12">
        			<div class="form-group">
	            		<label>Name</label>
	            		<input type="text" class="form-control" value="{{$product->name}}" name="name" placeholder="Product Name" required>
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col-sm-6">
	        		<div class="form-group">
	            		<label>Price</label>
	            		<input type="number" step="any" min="0" class="form-control" name="price" value="{{$product->price}}" placeholder="Price" required onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 ">
	            		<div class="help-block with-errors"></div>
	            	</div>
	        	</div>
                <div class="col-sm-6">
	            	<div class="form-group">
	            		<label>Product Tax</label>
	            		<select name="tax" class="selectpicker form-control show-menu-arrow show-tick" required data-show-subtext="true">
                            <option value="">Select GST Tax</option>
                            @foreach($taxes as $tax)
                                <option 
								value="{{$tax->id}}" 
								data-subtext="{{$tax->rate}} %"
								@if(count($product->tax) > 0 && ($tax->id == $product->item_tax[0]->tax_id))
									selected=""
								@endif
								>
									{{$tax->name}}
								</option>
                            @endforeach
                        </select>
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        	
        	</div>
        	<div class="row">
                <div class="col-sm-6">
	        		<div class="form-group">
	            		<label>Quantity <span class="text-secondary">(numbers only)</span></label>
	            		<input type="number" step="any" min="0" class="form-control" value="{{$product->quantity}}" name="quantity" placeholder="Quantity" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  event.charCode == 46 || event.charCode == 0 ">
	            		<div class="help-block with-errors"></div>
	            	</div>
	        	</div>
	        	<div class="col-sm-6">
	            	<div class="form-group">
	            		<label>Unit</label>
	            		<input type="text" class="form-control" pattern="[a-zA-Z]+" value="{{$product->unit}}" name="unit" placeholder="Unit of Quantity" >
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
	        </div>
        	<div class="row">
	        	<div class="col-sm-12">
	            	<div class="form-group">
	            		<label>Product Description</label>
	            		<textarea class="form-control" name="description" placeholder="Description">{{$product->description}}</textarea>
	            		<div class="help-block with-errors"></div>
	            	</div>
        		</div>
        	</div>
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