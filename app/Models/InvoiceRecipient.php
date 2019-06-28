<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceRecipient extends Model
{
    protected $fillable = [
    	'invoice_id','recipient_id'
    ];

    public $timestamps = false;	
}
