<?php

namespace App\Services;

use App\Repositories\RecipientRepository;
use Illuminate\Http\Request;

class RecipientService
{

	protected $repository;

	function __construct(RecipientRepository $repo){
		$this->repository = $repo;
	}

	function addRecipient($data){
		return $this->repository->create($data);
	}

	function getRecipients($filter = [])
	{
		return $this->repository->getUserRecipients($filter);
	}

	function update($data,$recipient){
		$this->repository->update($data,$recipient);
	}

}