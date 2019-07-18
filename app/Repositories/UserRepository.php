<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Address;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class UserRepository
{

	function saveUser($data){
		$user = User::create($data);
		$user->assignRole('Admin');
		return $user;
	}

	function saveUserDetails($data,$user_id){
		$address_id = Address::create($data['address'])->id;

		$details = $data['details'];

		$details['user_id'] = $user_id;
		$details['business_address_id'] = $address_id;

		return UserDetail::create($details);
	}

	function updateUser($data,$user){
		$user->fill($data['personal'])->save();

		if($user->details){
			$user->details->address->update($data['address']);
			$user->details()->update($data['details']);
		}
		else
		{
			$this->saveUserDetails($data,$user->id);
		}

		return $user;
	}

	function updateTour($user){
		$user->update(['shepherd'=>1]);

		return $user;
	}
}
