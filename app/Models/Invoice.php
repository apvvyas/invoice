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

    function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    function owner_address(){
        return $this->hasOneThrough(
            Address::class,
            UserDetail::class,
            'user_id',
            'id',
            'id',
            'address_id'
        );
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

    function total(){
        return $this->hasOne(InvoiceTotal::class);
    }

    function items(){
        return $this->hasMany(InvoiceItem::class);
    }

    function tax(){
        return $this->hasMany(InvoiceTax::class);
    }

    function isDue(){
    	return Carbon::parse($this->attributes['due_at'])->diffInDays(Carbon::now(),false);
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

    function scopePending($query){
        return $query->where('status','SAVED');
    }

    function scopePaid($query){
        return $query->where('status','PAID');        
    }

    function scopeOverdue($query){
        return $query->where('status','SAVED')->whereDate('due_at','>',Carbon::now());        
    }

    function isPending(){
        if($this->attributes['status'] == 'SAVED')
            return true;

        return false;
    }

    function isPaid(){
        if($this->attributes['status'] == 'PAID')
            return true;

        return false;
    }

    function setPending(){
        $this->attributes['status'] = 'SAVED';

        return $this;
    }

    function setPaid(){
        $this->attributes['status'] = 'PAID';
        return $this;
    }
}
