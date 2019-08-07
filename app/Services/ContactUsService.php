<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\ContactUsRepository;

class ContactUsService
{
	protected $repository;

	function __construct(ContactUsRepository $repo){
		$this->repository = $repo;
	}

	function save($data){
		return $this->repository->create($data);
	}

	function update($data,$entry){
		return $this->repository->update($data,$entry);
	}

	function read($data,$entry){
		if($entry->read_at == NULL){
			$data = ['read_at' => Carbon::now()->format('Y-m-d H:i:s')];
			return $this->repository->update($data,$entry);
		}
		return $entry;
		
	}
}