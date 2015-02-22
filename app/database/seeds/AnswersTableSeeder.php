<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AnswersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Answer::create([
				'question_id' => 1 ,
				'user_id' => $index ,
				'answer' => $faker->text ,
				'like' => $index ,
			]);
		}
	
		foreach(range(1, 10) as $index)
		{
			Answer::create([
				'question_id' => 2 ,
				'user_id' => $index ,
				'answer' => $faker->text ,
				'like' => $index ,
			]);
		}

		foreach(range(1, 10) as $index)
		{
			Answer::create([
				'question_id' => 3 ,
				'user_id' => $index ,
				'answer' => $faker->text ,
				'like' => $index ,
			]);
		}

	}

}