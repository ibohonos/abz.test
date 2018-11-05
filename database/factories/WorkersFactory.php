<?php

use Faker\Generator as Faker;

$factory->define(App\Worker::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'salary' => $faker->numberBetween(500, 2500) . '$',
		'position_id' => $faker->numberBetween(1, 5),
		'worker_id' => $faker->numberBetween(0, 500),
		// 'worker_id' => factory(App\Worker::class)->make()->id,
		'avatar' => $faker->imageUrl(400, 400),
		// 'accepted_at' => $faker->dateTime,
		'accepted_at' => $faker->dateTimeBetween('-2 years', '+2 years', date_default_timezone_get()),
	];
});
