@extends('layouts.app')

@push('css')

	<link rel="stylesheet" href="/css/datatables/datatables.min.css">

@endpush


@push('vendor-js')

<script src="/vendors/js/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/jszip.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/buttons.print.min.js" type="text/javascript"></script>

@endpush

@push('page-vendor-js')
	
	<script src="/js/pages/tax-list.js" type="text/javascript"></script>

@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Tax List</h2>
        <div class="widget-options">
			<div class="btn-group" role="group">
				<a href="{{route('tax.create')}}" class="btn btn-primary ripple">Add Tax</a>
			</div>
		</div>
    </div>
    <div class="widget-body">
        <div class="row flex-row justify-content-center">
            <div class="col-xl-12">
            	<div class="table-responsive">
					<table id="export-table" class="table mb-0" data-url="{{route('taxes.list')}}">
						<thead>
							<tr>
								<th>Name</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Created On</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>

            </div>
        </div>
    </div>
</div>



@stop