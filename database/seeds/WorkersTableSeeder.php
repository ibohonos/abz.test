<?php

use Illuminate\Database\Seeder;

class WorkersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$boss = factory(App\Worker::class, 10)->create();

		$worker_1 = factory(App\Worker::class, 20)->create()->each(function($worker) use ($boss) {
			$worker->worker_id = $boss->random()->id;
			$worker->save();
		});

		$worker_2 = factory(App\Worker::class, 100)->create()->each(function($worker) use ($worker_1) {
			$worker->worker_id = $worker_1->random()->id;
			$worker->save();
		});

		$worker_3 = factory(App\Worker::class, 1000)->create()->each(function($worker) use ($worker_2) {
			$worker->worker_id = $worker_2->random()->id;
			$worker->save();
		});

		$worker_4 = factory(App\Worker::class, 50)->create()->each(function($worker) use ($worker_3) {
			$worker->worker_id = $worker_3->random()->id;
			$worker->save();
		});

	}
}
