<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = [
    	'user_id','company_name','email','phone','address_id','message'
    ];
}
