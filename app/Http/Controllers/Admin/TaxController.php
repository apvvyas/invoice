<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\TaxService;
use App\DataTables\TaxDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tax\AddRequest;
use App\Http\Requests\Tax\UpdateRequest;

class TaxController extends Controller
{

    protected $service;


    function __construct(TaxService $service){
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.taxes.list');
    }

     /**
     * Fetch listing of the resource.
     *
     * @return \App\DataTables\ProductDataTable
     */
    public function list(TaxDataTable $datatable){

        return $datatable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.taxes.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $tax = $this->service->save($request->all());

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Tax store failed';
        
        if($tax){
            $status = Response::HTTP_OK;
            $message = 'Tax stored successfully';
        }

        return redirect()->route('taxes')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        return view('admin.taxes.edit')->with(compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Tax $tax)
    {
        $tax = $this->service->update($request->all(),$tax);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Product update failed';
        
        if($tax){
            $status = Response::HTTP_OK;
            $message = 'Product updated successfully';
        }

        return redirect()->route('taxes')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($tax->delete()){
            
            $status = Response::HTTP_OK;
            $message = 'Product deleted successfully';
        
        }
        
        return redirect()->route('taxes')->with($message);
    }
}
