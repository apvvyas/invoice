@extends('layouts.app')

@push('page-vendor-js')
<script src="/vendors/js/chart/chart.min.js"></script>
<script src="/vendors/js/progress/circle-progress.min.js"></script>
@endpush

@push('snippets')

<script src="/js/pages/dashboard.js"></script>
@endpush

@section('content')

<div class="row flex-row">
    <!-- Begin Widget 16 -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="widget widget-16 has-shadow">
            <div class="widget-body">
                <div class="row">
                    <div class="col-xl-12 d-flex flex-column justify-content-center align-items-center">
                        <div class="counter">{{$productCount}}</div>
                        <div class="total-views">Total Products</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Widget 16 -->
    <!-- Begin Widget 17 -->
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="widget widget-17 has-shadow">
            <div class="widget-body">
                <div class="row">
                    <div class="col-xl-12 d-flex flex-column justify-content-center align-items-center">
                        <div class="counter">{{$recipientCount}}</div>
                        <div class="total-visitors">Total Recipients</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="widget widget-17 has-shadow">
            <div class="widget-body">
                <div class="row">
                    <div class="col-xl-12 d-flex flex-column justify-content-center align-items-center">
                        <div class="counter">{{$invoiceCount}}</div>
                        <div class="total-visitors">Total Invoices</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Widget 17 -->
</div>

<div class="row flex-row">
    <div class="col-xl-12 col-md-6">
        <!-- Begin Widget 09 -->
        <div class="widget widget-09 has-shadow">
            <!-- Begin Widget Header -->
            <div class="widget-header d-flex align-items-center">
                <h2>Invoice</h2>
                <div class="widget-options">
                    <a href="{{route('invoices')}}" class="btn btn-shadow">View all</a>
                </div>
            </div>
            <!-- End Widget Header -->
            <!-- Begin Widget Body -->
            <div class="widget-body">
                <div class="row">
                    <div class="col-xl-10 col-12 no-padding">
                        <div>
                            <canvas id="orders"></canvas>
                        </div>
                    </div>
                    <div class="col-xl-2 col-12 d-flex flex-column my-auto no-padding text-center">
                        <div class="new-orders">
                            <div class="title">New Invoices</div>
                            <div class="circle-orders">
                                <div class="percent-orders"></div>
                            </div>
                        </div>
                        <div class="some-stats mt-5">
                            <div class="title">Total Paid</div>
                            <div class="number text-blue">{{$total_paid}}</div>
                        </div>
                        <div class="some-stats mt-3">
                            <div class="title">Total Pending</div>
                            <div class="number text-blue">{{$total_pending}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Widget 09 -->
    </div>
</div>

<div class="row flex-row">
    <div class="col-xl-12">
        <!-- Begin Widget 07 -->
        <div class="widget widget-07 has-shadow">
            <!-- Begin Widget Header -->
            <div class="widget-header bordered d-flex align-items-center">
                <h2>Recent Invoice</h2>
                <div class="widget-options">
                    <div class="btn-group" role="group">
                       <a href="{{route('invoices')}}" class="btn btn-shadow">View all</a>
                    </div>
                </div>
            </div>
            <!-- End Widget Header -->
            <!-- Begin Widget Body -->
            <div class="widget-body">
                <div class="table-responsive table-scroll padding-right-10" style="max-height:520px;">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Invoice Title</th>
                                <th>Recipient</th>
                                <th>Status</th>
                                <th>Creation Date</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentFiveInvoices as $invoice)
                            <tr>
                                <td><span class="text-primary">{{$invoice->title}}</span></td>
                                <td>{{$invoice->recipient->company_name}}</td>
                                @if($invoice->isPaid())
                                <td><span style="width:100px;"><span class="badge-text badge-text-small success">Paid</span></span></td>
                                @elseif($invoice->isDue() > 0  )
                                <td><span style="width:100px;"><span class="badge-text badge-text-small danger">Overdue</span></span></td>
                                @else
                                <td><span style="width:100px;"><span class="badge-text badge-text-small i">Pending</span></span></td>
                                @endif
                                <td>{{$invoice->created_at->format('d-m-Y')}}</td>
                                <td>{{$invoice->due_at->format('d-m-Y')}}</td>
                                <td class="td-actions">
                                    <a href="{{route('invoice.show',['invoice'=>$invoice->id])}}"><i class="la la-eye view"></i></a>
                                    <a href="{{route('invoice.status',['invoice'=>$invoice->id])}}"><i class="la la-upload upload"></i></a>
                                    <a href="{{route('invoice.destroy',['invoice'=>$invoice->id])}}" class="delete-confirmation-button"><i class="la la-close delete"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Invoices available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Widget Body -->
            <!-- Begin Widget Footer -->
            <!-- <div class="widget-footer d-flex align-items-center">
                <div class="mr-auto p-2">
                    <span class="display-items">Showing 1-30 / 150 Results</span>
                </div>
                <div class="p-2">
                    <nav aria-label="...">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <span class="page-link"><i class="ion-chevron-left"></i></span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                                <span class="page-link">2<span class="sr-only">(current)</span></span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="ion-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> -->
            <!-- End Widget Footer -->
        </div>
        <!-- End Widget 07 -->
    </div>
</div>


@endsection
