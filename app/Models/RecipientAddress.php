<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipientAddress extends Model
{
	protected $fillable = [
		'recipient_id','address_id'
	];    
}
