<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
    	'item_id','invoice_id','quantity','total'
    ];

    function item(){
    	return $this->belongsTo(Item::class);
    }
}
