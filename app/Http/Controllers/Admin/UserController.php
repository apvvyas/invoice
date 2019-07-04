<?php

namespace App\Http\Controllers\Admin;

use Auth;
use JavaScript;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserService;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AddRequest;
use App\Http\Requests\Users\UpdateRequest;


class UserController extends Controller
{

    protected $service;


    function __construct(UserService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.list');
    }


    /**
     * Fetch listing of the resource.
     *
     * @return \App\DataTables\UserDataTable
     */
    public function list(UserDataTable $datatable){

        return $datatable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $user = $this->service->save($request->all());

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'User store failed';
        
        if($user){
            $status = Response::HTTP_OK;
            $message = 'User stored successfully';
        }

        return response()->json(compact('message'),$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show')->with('user',$user);
    }

    public function profile(){
        $user = Auth::user();
        JavaScript::put('user_id',$user->id);
        return view('admin.users.edit')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        JavaScript::put('user_id',$user->id);
        return view('admin.users.edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user = $this->service->update($request->all(),$user);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'User update failed';
        
        if($user){
            $status = Response::HTTP_OK;
            $message = 'User updated successfully';
        }

        return response()->json(compact('message'),$status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($user->delete()){
            
            $status = Response::HTTP_OK;
            $message = 'User deleted successfully';
        
        }
        
        return redirect()->route('users')->with($message);
    }
}
