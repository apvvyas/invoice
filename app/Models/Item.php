<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    	'user_id','name','price','description','quantity','unit'
    ];

    function item_tax(){
        return $this->hasMany(ItemTax::class,'item_id');
    }

    function tax(){
        
        return $this->hasManyThrough(
            Tax::class,
            ItemTax::class,
            'item_id',
            'id',
            'id',
            'tax_id'
        );
       
    }
}
