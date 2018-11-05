<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Worker;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Worker::deleting(function ($worker) {
			foreach ($worker->subjects as $subject) {
				$subject->worker_id = $worker->worker_id;
				$subject->save();
			}
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
