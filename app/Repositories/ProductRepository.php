<?php

namespace App\Repositories;

use Auth;
use Illuminate\Http\Request;

class ProductRepository
{
    function create($data){

		$item = Auth::user()->items()->create($data);

		$item->tax()->insert([
            'item_id'=>$item->id,
            'tax_id'=>$data['tax']
        ]);

		return $item;
    }
    
    function update($data,$item){
		$item->fill($data)->save();
		$item->tax()->update([
            'tax_id'=>$data['tax']
        ]);
		return $item;
	}
}
