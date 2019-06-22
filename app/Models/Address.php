<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
    	'address_1','address_2','city','state','country','postal_code'
    ];
}
