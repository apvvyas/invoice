@extends('layouts.app')

@push('css')

	<link rel="stylesheet" href="/css/datatables/datatables.min.css">

@endpush


@push('datatable-js')

<script src="/vendors/js/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/jszip.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="/vendors/js/datatables/buttons.print.min.js" type="text/javascript"></script>

@endpush

@push('snippets')
	
	<script src="/js/pages/recipient-list.js" type="text/javascript"></script>

@endpush


@section('content')
<div class="widget has-shadow">
    <div class="widget-header bordered no-actions d-flex align-items-center">
        <h2>Recipient List</h2>
        <div class="widget-options">
			<div class="btn-group" role="group">
				<a href="{{route('recipient.create')}}" class="btn btn-primary ripple">Add Recipient</a>
			</div>
		</div>
    </div>
    <div class="widget-body">
        <div class="row flex-row justify-content-center">
            <div class="col-xl-12">
            	<div class="table-responsive">
					<table id="export-table" class="table mb-0" data-url="{{route('recipients.list')}}">
						<thead>
							<tr>
								<th>Company</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Actions</th>
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


@push('modal')


<div id="success-modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="sa-icon sa-success animate" style="display: block;">
                    <span class="sa-line sa-tip animateSuccessTip"></span>
                    <span class="sa-line sa-long animateSuccessLong"></span>
                    <div class="sa-placeholder"></div>
                    <div class="sa-fix"></div>
                </div>
                <div class="section-title mt-5 mb-2">
                    <h2 class="text-gradient-02">Thank you!</h2>
                </div>
                <p class="mb-5">The form was submitted successfully</p>
                <button type="button" class="btn btn-shadow mb-3" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

@endpush