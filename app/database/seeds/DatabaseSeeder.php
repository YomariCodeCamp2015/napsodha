<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('AnswersTableSeeder');
		$this->call('QuestionsTableSeeder');
		$this->call('SectionsTableSeeder');
		$this->call('QuestionsectionsTableSeeder');
		 
	}

}
