<?php

namespace App\Http\Controllers\Admin;

use PDF;
use JavaScript;
use App\Models\Tax;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'taxes' => Tax::all(),
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
        $invoice = $this->service->save($request->all());

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Invoice store failed';
        
        if($invoice){
            $status = Response::HTTP_OK;
            $message = 'Invoice stored successfully';
        }

        return response()->json(compact('message'),$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoice.show')->with([
                    'invoice'=>$invoice,
                    'owner'=>$invoice->owner()->first()
                ]);
    }

    /**
     * Export PDF of the specified resource.
     *
     * @param  App\Models\Invoice;
     * @return \Illuminate\Http\Response
     */
    public function pdf(Invoice $invoice)
    {

        $pdf = PDF::loadView('admin.invoice.export-pdf', [
                        'invoice'=>$invoice,
                        'owner'=>$invoice->owner()->first(),
                        'pdf'=>true
                ]);
        return $pdf->download('invoice.pdf');
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
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($invoice->delete()){
            
            $status = Response::HTTP_OK;
            $message = 'Invoice deleted successfully';
        
        }
        
        return redirect()->back()->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Invoice $invoice)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($this->service->updateStatus($invoice)){
            
            $status = Response::HTTP_OK;
            $message = 'Invoice status updated successfully';
        
        }
        
        return redirect()->back()->with($message);
    }
}
