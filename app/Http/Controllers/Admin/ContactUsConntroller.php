<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ContactUsService;
use App\DataTables\ContactUsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUs\AddRequest;
use App\Http\Requests\ContactUs\UpdateRequest;

class ContactUsConntroller extends Controller
{

    protected $service;


    function __construct(ContactUsService $service){
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.contactus.list');
    }

    /**
     * Fetch listing of the resource.
     *
     * @return \App\DataTables\ProductDataTable
     */
    public function list(ContactUsDataTable $datatable){

        return $datatable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contactus.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contactus = $this->service->save($request->all());

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'ContactUs store failed';
        
        if($contactus){
            $status = Response::HTTP_OK;
            $message = 'ContactUs stored successfully';
        }

        return redirect()->route('contactus')->with($message);
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
    public function edit(ContactUs $contactus)
    {
        return view('admin.contactus.edit')->with(compact('contactus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ContactUs $contactus)
    {
        $contactus = $this->service->update($request->all(),$contactus);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Product update failed';
        
        if($contactus){
            $status = Response::HTTP_OK;
            $message = 'Product updated successfully';
        }

        return redirect()->route('contactus')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactus)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($contactus->delete()){
            
            $status = Response::HTTP_OK;
            $message = 'Product deleted successfully';
        
        }
        
        return redirect()->route('contactus')->with($message);
    }

    /**
     * Read the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read(ContactUs $contactus){
        $contactus = $this->service->read($request->all(),$contactus);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Product update to read failed';
        
        if($contactus){
            $status = Response::HTTP_OK;
            $message = 'Product read updated successfully';
        }

        return redirect()->route('contactus')->with($message);
    }
}
