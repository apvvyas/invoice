<?php

namespace App\Services;

use App\Repositories\TaxRepository;

class TaxService
{
    protected $repository;

	function __construct(TaxRepository $repo){
		$this->repository = $repo;
	}

	function save($data){
		return $this->repository->create($data);
	}

	function update($data,$product){
		return $this->repository->update($data,$product);
	}
}