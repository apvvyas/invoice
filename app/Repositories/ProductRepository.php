<?php

namespace App\Repositories;

use Auth;
use Illuminate\Http\Request;

class ProductRepository
{
    function create($data){

		$item = Auth::user()->items()->create($data);

		$item->item_tax()->insert([
            'item_id'=>$item->id,
            'tax_id'=>$data['tax']
        ]);

		return $item;
    }
    
    function update($data,$item){
      $item->fill($data)->save();
      if($item->item_tax()->count()){
        $item->item_tax()->update([
          'tax_id'=>$data['tax']
        ]);
      }else{
        $item->item_tax()->insert([
          'item_id'=>$item->id,
          'tax_id'=>$data['tax']
        ]);
      }
      return $item;
    }

    function search($data){
      return Auth::user()->items()
            ->Where('name','like','%'.$data['search'].'%')
            ->orWhere('price','like',$data['search']."%")
            ->paginate(10);
    }

}
