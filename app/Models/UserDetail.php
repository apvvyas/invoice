<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
    	'user_id','phone','business_name','business_address_id','business_phone','business_tax_number'
    ];
}
