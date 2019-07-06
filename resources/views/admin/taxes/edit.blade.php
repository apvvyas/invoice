@extends('layouts.app')

@push('page-vendor-js')
	<script src="/js/components/validation/validation.min.js" type="text/javascript"></script>
@endpush

@push('snippets')

    <!--<script src="/js/pages/product-add.js"></script>-->
@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Edit Tax</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
                <a href="{{route('taxes')}}" class="btn btn-primary ripple">Back to Tax list</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
        <form id="add_tax" action="{{route('tax.update',['tax'=>$tax])}}" role="form" method="post" data-toggle="validator">
            @csrf
        	<div class="row">
        		<div class="col-sm-6">
        			<div class="form-group">
	            		<label>Name</label>
	            		<input type="text" class="form-control" name="name" value="{{$tax->name}}" placeholder="Tax Name" required>
	            		<div class="help-block with-errors"></div>
	            	</div>
	            </div>
                <div class="col-sm-6">
	        		<div class="form-group">
	            		<label>Rate</label>
	            		<input type="text" class="form-control" name="rate" value="{{$tax->rate}}" placeholder="Rate" required>
	            		<div class="help-block with-errors"></div>
	            	</div>
	        	</div>
	        </div>
        	<div class="row">
	        	<div class="col-sm-12">
	            	<div class="form-group">
	            		<label>Description</label>
	            		<textarea class="form-control" name="description" placeholder="Description">{{$tax->description}}</textarea>
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