<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $repository;

	function __construct(ProductRepository $repo){
		$this->repository = $repo;
	}

	function save($data){
		return $this->repository->create($data);
	}

	function update($data,$product){
		return $this->repository->update($data,$product);
	}

	function get($data){
		return $this->repository->search($data);
	}
}