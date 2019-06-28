<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Address;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserRepository
{

	function saveUser($data){
		return User::create($data);
	}

	function saveUserDetails($data,$user_id){
		$address_id = Address::create($data['address']);

		$details = $data['details'];

		$details['user_id'] = $user_id;
		$details['business_address_id'] = $address_id;

		return UserDetail::create($details);
	}
}
