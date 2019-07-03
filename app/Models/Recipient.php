<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = [
    	'user_id','company_name','email','phone','address_id'
    ];

    function address(){
    	return $this->hasOneThrough(
    		Address::class,
    		RecipientAddress::class,
    		'recipient_id',
    		'id',
    		'id',
    		'address_id'
    	);
    }
}
