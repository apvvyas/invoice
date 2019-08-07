<?php

namespace App\Http\Controllers\Admin;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\TodoService;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{

    // Service Variables

    protected $service;

    /**
     * Display a listing of the resource.
     *
     * @params App\Services\InvoiceService
     */
    function __construct(TodoService $todo_service)
    {
        $this->service = $todo_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param 
     * @return \Illuminate\Http\JSONResponse
     */
    public function list(Request $request)
    {
        $data = $this->service->list($request->all());

        return response()->json(view('admin.todos.list')->with(['todos'=>$data])->render(),Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Todo store failed';

        $todo = $this->service->save($request->all());

        if($todo->id){
            $status = Response::HTTP_OK;
            $message = 'Todo stored successfully';
        }

        return response()->json($message,$status);
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
    public function edit($id)
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
    public function update(Request $request, Todo $todo)
    {
        
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Todo update failed';

        $todo = $this->service->update($request->all(),$todo);
        
        if($todo->id){
            $status = Response::HTTP_OK;
            $message = 'Todo updated successfully';
        }

        return response()->json($message,$status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Todo delete failed';

        if($todo->delete()){
            $status = Response::HTTP_OK;
            $message = 'Todo deleted successfully';
        }

        return response()->json($message,$status);
    }



    /**
     * Checkoff the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function checkoff(Request $request, Todo $todo)
    {
        
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Todo checkoff failed';

        $checkedOff = $this->service->checkoff($todo);
        
        if($checkedOff->id){
            $status = Response::HTTP_OK;
            $message = 'Todo checked off successfully';
        }

        return response()->json($message,$status);
    }
}
