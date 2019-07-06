<?php

namespace App\Http\Controllers\Admin;

use JavaScript;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProductService;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\AddRequest;
use App\Http\Requests\Products\UpdateRequest;

class ProductController extends Controller
{
    protected $service;


    function __construct(ProductService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.list');
    }


    /**
     * Fetch listing of the resource.
     *
     * @return \App\DataTables\ProductDataTable
     */
    public function list(ProductDataTable $datatable){

        return $datatable->ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $product = $this->service->save($request->all());

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Product store failed';
        
        if($product){
            $status = Response::HTTP_OK;
            $message = 'Product stored successfully';
        }

        return response()->json(compact('message'),$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $product)
    {
        return view('admin.products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $product)
    {
        JavaScript::put('product_id',$product->id);
        return view('admin.products.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Item $product)
    {
        $product = $this->service->update($request->all(),$product);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'Product update failed';
        
        if($product){
            $status = Response::HTTP_OK;
            $message = 'Product updated successfully';
        }

        return response()->json(compact('message'),$status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $product)
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR; 
        $message = 'Some Error occured please try again';
        
        if($product->delete()){
            
            $status = Response::HTTP_OK;
            $message = 'Product deleted successfully';
        
        }
        
        return redirect()->route('products')->with($message);
    }
}
