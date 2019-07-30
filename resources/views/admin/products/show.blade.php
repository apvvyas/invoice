@extends('layouts.app')

@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Product Details</h2>
        <div class="widget-options">
            <div class="btn-group" role="group">
                @can('edit_product')
                <a href="{{route('product.edit',['product'=>$product])}}" class="btn btn-primary ripple">Edit Product</a>
                @endcan
                <a href="{{route('products')}}" class="btn btn-secondary ripple">Back to Products</a>
            </div>
        </div>
    </div>
    <div class="widget-body">
    	<div class="row">
            <div class="col-sm-12">
                <h5><strong>Name</strong></h5>
                <p>{{$product->name}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h5><strong>Price</strong></h5>
                <p>$ {{$product->price}}</p>
            </div>
            <div class="col-sm-4">
                <h5><strong>Tax</strong></h5>
                <p>{{$product->tax[0]->rate}} % [{{$product->tax[0]->name}}]</p>
            </div>
            <div class="col-sm-4">
                <h5><strong>Quantity</strong></h5>
                <p>{{$product->quantity}} {{$product->unit}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5><strong>Description</strong></h5>
                <p>{!! !empty($product->description) ? nl2br($product->description) : '-'!!}</p>
            </div>
        </div>
    </div>
</div>

@stop