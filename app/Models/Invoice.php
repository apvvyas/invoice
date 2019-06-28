<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{

	use SoftDeletes;

    protected $fillable = [
    	'title','user_id','pay_address_id','bill_address_id','status','due_at'
    ];

    protected $casts = [
    	'due_at' => 'datetime'
    ];


    protected function setDueAtAttribute($due_at){
    	$this->attributes['due_at'] = Carbon::parse($due_at)->format('Y-m-d H:i:s');
    }

    function recipient(){
    	return $this->hasOneThrough(
    		Recipient::class,
    		InvoiceRecipient::class,
    		'invoice_id',
    		'id',
    		'id',
    		'recipient_id'
    	);
    }

    function isDue(){
    	return Carbon::parse($this->attributes['due_at'])->diffInSeconds(Carbon::now());
    }

    function getDueAtAttribute(){
    	return Carbon::parse($this->attributes['due_at']);
    }

    function getStatusAttribute(){
    	$status = 'Pending';
        if($this->attributes['status'] == 'PAID'){
            $status  = 'Paid';
        }
        elseif(($this->attributes['status'] == 'SAVED') && ($this->isDue() > 0)){
        	$status  = 'Overdue';
        }

        return $status;
    }
}
