<?php

namespace App\Http\Controllers\Admin;

use JavaScript;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{

    // Service Variables

    protected $service;

    /**
     * Display a listing of the resource.
     *
     * @params App\Services\InvoiceService
     */
    function __construct(InvoiceService $invoice_service)
    {
        $this->service = $invoice_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.invoice.list');
    }


    /**
     * Display a listing of the resource.
     *
     * @param App\DataTables\InvoiceDatatable
     * @return \Illuminate\Http\JSONResponse
     */
    public function list(InvoiceDataTable $datatable)
    {
        return $datatable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        JavaScript::put('invoice_id',(int)$this->service->getLastInsertId()+1);
        return view('admin.invoice.add',[
            'invoice_id'=>((int)$this->service->getLastInsertId()+1),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
