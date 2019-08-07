<?php

namespace App\Services;

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

		$filter = [
			'today'=>'getTodayList',
			'yesterday'=>'getYesterDayList',
			'default'=>'getList'

		];

		$func = $filter['default'];

		if(!empty($request['filter']))
			$func = $filter[$request['filter']];

		return $this->repository->{$func}($request,Auth::user());
	}

	function checkoff($todo){
		return $this->repository->checkoff($todo);
	}
}