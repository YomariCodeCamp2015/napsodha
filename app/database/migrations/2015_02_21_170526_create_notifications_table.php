<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$source_type  = ['answer' , 'discussion'] ;
			$parent_type  = ['answer' , 'question' ,'discussion'] ;

			$table->increments('id');
			$table->integer('user_id') ;
			$table->integer('source_id') ;
			$table->enum('source_type' ,$source_type) ;
			$table->integer('parent_id') ;
			$table->enum('parent_type' ,$parent_type) ;
			$table->enum('seen', array(0,1))->default(0);
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
		Schema::drop('notifications');
	}

}
