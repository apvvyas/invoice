<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserService
{

	protected $repository;

	function __construct(UserRepository $repo){
		$this->repository = $repo;
	}

	function save($data){

		$user_id = $this->repository->saveUser([
				'first_name'=>$data['personal']['firstName'],
				'last_name'=>$data['personal']['lastName'],
				'name'=>$data['personal']['firstName']." ".$data['personal']['lastName'],
				'email'=>$data['personal']['email'],
				'email_verified_at'=> Carbon::now()->format('Y-m-d H:i:s'),
				'password' => $data['personal']['password']
			]);

		$user_details_id = $this->repository->saveUserDetails([
			'address' => [
				'address_1' => $data['business']['address1'],
				'address_2' => $data['business']['address2'],
				'city' => $data['business']['city'],
				'state' => $data['business']['state'],
				'country' => $data['business']['country'],
				'postal_code' => $data['business']['postal']
			]

			'details'=>[
				'user_id'=>'',
				'phone' => $data['personal']['phone'],
				'business_address_is'=>'',
				'business_phone'=>$data['business']['phone'],
				'business_tax_number' => $data['business']['taxDetails']
			]
		]);

		return $user_id;
	}
}