<?php

namespace App\Repositories;

use Auth;
use App\Models\Address;
use App\Models\Recipient;
use App\Models\RecipientAddress;

class RecipientRepository
{
	function create($data){

		$recipient = Auth::user()->recipients()->create($data);

		$this->registerAddress($data,$recipient);

		return $recipient;
	}

	function getUserRecipients($filter = []){

		$default_filter = [
			'select'=>['id','company_name'],
			'company_name'=>'',
			'gst_number'=>'',
			'page'=>0,
			'limit'=>10
		];

		$filter = array_merge($default_filter,$filter);

		$recip = Auth::user()->recipients();
		
		if(!empty($filter['company_name'])){
			$recip->where('company_name','LIKE','%'.$filter['company_name'].'%');
		}

		if(!empty($filter['gst_number'])){
			$recip->where('gst_number','LIKE','%'.$filter['gst_number'].'%');
		}

		return $recip->skip($filter['page'])->take($filter['limit'])->get();		
	}

	function update($data,$recipient){
		$recipient->fill($data)->save();

		if($recipient->address)
			$recipient->address->update($data);
		else
			$this->registerAddress($data,$recipient);


		return $recipient;
	}

	function registerAddress(array $data,Recipient $recipient){
		
		$address = NULL;
		if(!empty($data['address_1']) && !empty($data['address_1']))
		{
			$address = Address::create($data);	
		}

		if(!empty($address))
		{
			RecipientAddress::insert([
				'recipient_id'=>$recipient->id,
				'address_id'=>$address->id
			]);	
		}

		return $address;
	}
}
