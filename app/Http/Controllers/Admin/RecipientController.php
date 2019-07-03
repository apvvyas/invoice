<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\RecipientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Recipients\AddRequest;
use App\Http\Requests\Recipients\UpdateRequest;
use App\DataTables\RecipientDataTable;


class RecipientController extends Controller
{

    protected $service;

    function __construct(RecipientService $service){
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.recipients.list');
    }

    /**
     * Fetch listing of the resource.
     *
     * @return \App\DataTables\UserDataTable
     */
    public function list(RecipientDataTable $datatable){

        return $datatable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recipients.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $recipient = $this->service->addRecipient($request->all());
        
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Recipient store failed';
        
        if($recipient->id){
            $status = Response::HTTP_OK;
            $message = 'Recipient stored successfully';
        }

        return response()->json($message,$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipient $recipient)
    {
       return view('admin.recipients.show')->with(['recipient'=>$recipient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipient $recipient)
    {
        return view('admin.recipients.edit')->with(['recipient'=>$recipient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipient $recipient)
    {
        $recipient = $this->service->update($request->all(),$recipient);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'User update failed';
        
        if($recipient){
            $status = Response::HTTP_OK;
            $message = 'User updated successfully';
        }

        return redirect()->route('recipients')->with(compact('status','message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipient $recipient)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($recipient->delete()){
            
            $status = Response::HTTP_OK;
            $message = 'Recipient deleted successfully';
        
        }
        
        return redirect()->route('recipients')->with($message);
    }

    public function list_for_invoice(Request $request){

        $html = view('admin.invoice.recipients',['recipients'=>$this->service->getRecipients($request->all())])->render();
        return response()->json(compact('html'),Response::HTTP_OK);
    }
}
