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
		factory(App\Worker::class, 5000)->create();/*->each(function ($w) {
			$w->boss()->save(factory(App\Worker::class)->make());
		});*/
	}
}
