<?php

namespace App\Services\;

use Auth;
use App\Repositories\TodoRepository;

class TodoService
{
	protected $repository;

	function __construct(TodoRepository $repository){
		$this->repository = $repository;
	}

	function save($request){
		return $this->repository->save($request,Auth::user());
	}

	function list($request){
		return $this->repository->save($request,Auth::user());
	}
}