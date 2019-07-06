<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    	'user_id','name','price','description','quantity','unit'
    ];

    function tax(){
        return $this->hasMany(ItemTax::class,'item_id');
    }
}
