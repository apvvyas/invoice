<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Models\User;

class TodoRepository
{
	function save($data,User $user){
		$todo = Todo::create(['message' => $data['message']]);

		$todo->user()->associate($user);
	}

	function getTodayList()
	{

	}

	function getYesterDayList()
	{

	}

	function getList($data,User $user){

		$todos = $user->todos()->orderBy('created_at');

		if($data['start_time']){
			$todos->where('created_at','>=',$data['start_time']);
		}

		if($data['end_time']){
			$todos->where('created_at','<=',$data['end_time']);
		}

		return $todos->paginate(15);
	}
}
