<?php

namespace App\Repositories;

use Auth;
use App\Models\Address;
use App\Models\Recipient;
use App\Models\RecipientAddress;

class RecipientRepository
{
	function create($data){
		$address = Address::create($data);

		$recipient = Auth::user()->recipients()->create($data);

		RecipientAddress::create([
			'recipient_id'=>$recipient->id,
			'address_id'=>$address->id
		]);

		return $recipient;
	}

	function getUserRecipients($filter = []){

		$default_filter = [
			'select'=>['id','company_name']
			'company_name'=>'',
			'gst_number'=>'',
			'page'=>0,
			'limit'=>10
		];

		$filter = array_merge($default_filter,$filter);

		$recip = Auth::user()->recipients();
		
		if(!empty($filter['company_name'])){
			$recip->where('company_name',$filter['company_name']);
		}

		if(!empty($filter['gst_number'])){
			$recip->where('gst_number',$filter['gst_number']);
		}

		return $recip->skip($filter['page'])->take($filter['limit'])->get();		
	}
}
