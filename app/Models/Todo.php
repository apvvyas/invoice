<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
	use SoftDeletes;

    protected $fillable = ['message','scheduled_at'];

    protected $casts = [
    	'scheduled_at' => 'datetime'
    ];

    function user(){
    	$this->belongsTo(User::class);
    }
}
