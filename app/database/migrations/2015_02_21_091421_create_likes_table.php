<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('likes', function(Blueprint $table)
		{
			$source_type = ['question' ,'answer'] ;

			$table->increments('id');
			$table->integer('user_id');
			$table->integer('source_id');
			$table->enum('source_type' , $source_type);
			$table->enum('like' , array(0,1,2)); //0 is nothing , 1 is liked , 2 is disliked
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('likes');
	}

}
