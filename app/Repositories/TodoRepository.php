<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Todo;
use App\Models\User;

class TodoRepository
{
	function save($data,User $user){
		$todo = $user->todos()->create(
			[
				'message' => $data['message'],
				'scheduled_at'=>!empty($data['scheduled_at'])?$data['scheduled_at']:Carbon::now()->format('Y-m-d H:i:s')
			]
		);

		return $todo;
	}

	function getTodayList($data,User $user)
	{	
		$data['end_time'] = Carbon::now()->format('Y-m-d H:i:s');
		$data['start_time'] = Carbon::now()->subDay()->format('Y-m-d H:i:s');
		
		return $this->getList($data,$user);
	}

	function getYesterDayList($data,User $user)
	{
		$data['end_time'] = Carbon::now()->subDay()->format('Y-m-d H:i:s');
		$data['start_time'] = Carbon::now()->subDay()->subDay()->format('Y-m-d H:i:s');
		
		return $this->getList($data,$user);
	}

	function getList($data,User $user){

		$todos = $user->todos()->orderBy('scheduled_at','DESC');

		if(!empty($data['start_time'])){
			$todos->where('scheduled_at','>=',$data['start_time']);
		}

		if(!empty($data['end_time'])){
			$todos->where('scheduled_at','<=',$data['end_time']);
		}

		return $todos->paginate(15);
	}

	function checkoff($todo){
		$todo->status = 1;
		$todo->save();
		return $todo;
	}
}
