<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

class UserService
{

	protected $repository;

	function __construct(UserRepository $repo){
		$this->repository = $repo;
	}

	function save($data){

		$user = $this->repository->saveUser([
				'first_name'=>$data['personal']['firstName'],
				'last_name'=>$data['personal']['lastName'],
				'name'=>$data['personal']['firstName']." ".$data['personal']['lastName'],
				'email'=>$data['personal']['email'],
				'phone' => $data['personal']['phone'],
				'email_verified_at'=> Carbon::now()->format('Y-m-d H:i:s'),
				'password' => Hash::make($data['personal']['password'])
			]);

		$user_details_id = $this->repository->saveUserDetails([
			'address' => [
				'address_1' => $data['business']['address1'],
				'address_2' => $data['business']['address2'],
				'city' => $data['business']['city'],
				'state' => $data['business']['state'],
				'country' => $data['business']['country'],
				'postal_code' => $data['business']['postal']
			],

			'details'=>[
				'user_id'=>'',
				'business_name' => $data['business']['name'],
				'business_address_is'=>'',
				'business_phone'=>$data['business']['phone'],
				'business_tax_number' => $data['business']['taxDetails']
			]
		],$user->id);

		return $user;
	}

	function update($data,$user,$hasLogo = false){

		$this->repository->updateUser([
			'personal'=>[
				'first_name'=>$data['personal']['firstName'],
				'last_name'=>$data['personal']['lastName'],
				'name'=>$data['personal']['firstName']." ".$data['personal']['lastName'],
				'password' => !empty($data['personal']['password'])?Hash::make($data['personal']['password']):$user->password,
				'phone' => $data['personal']['phone']
			],
			'address' => [
				'address_1' => $data['business']['address1'],
				'address_2' => $data['business']['address2'],
				'city' => $data['business']['city'],
				'state' => $data['business']['state'],
				'country' => $data['business']['country'],
				'postal_code' => $data['business']['postal']
			],

			'details'=>[
				'business_name' => $data['business']['name'],
				'business_phone'=>$data['business']['phone'],
				'business_tax_number' => $data['business']['taxDetails']
			]
		],$user);

		if($hasLogo){
			$user->addMediaFromRequest('logo')->toMediaCollection('company-logo');
		}

		return $user;

	}

	function updateTourComplete($user){
		return $this->repository->updateTour($user);
	}
}