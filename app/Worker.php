<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
	protected $fillable = [
		'name', 'accepted_at', 'salary', 'position_id', 'worker_id', 'avatar'
	];

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function boss()
	{
		return $this->belongsTo(Worker::class, 'worker_id');
	}

	public function subjects()
	{
		return $this->hasMany(Worker::class, 'worker_id');
	}
}
