<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SectionsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Section::create([
			'name' =>  $faker->text ,
			'author_id' => $index ,
			'about' => $faker->text ,
			]);
		}
	}

}