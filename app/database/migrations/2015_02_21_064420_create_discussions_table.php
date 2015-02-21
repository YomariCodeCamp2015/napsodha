<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscussionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discussions', function(Blueprint $table)
		{
			$source_type = [ 'question' , 'answer' ] ;

			$table->increments('id') ;
			$table->integer('user_id') ;
			$table->integer('source_id') ;
			$table->enum('source_type' , $source_type) ;
			$table->string('discussion') ;
			$table->timestamps() ;
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('discussions');
	}

}
