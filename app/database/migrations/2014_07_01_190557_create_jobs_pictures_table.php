<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsPicturesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs_pictures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('jobs_id')->nullable();
	        $table->string('user_id');
	        $table->text('filename', 255);
	        $table->timestamp('deleted_at')->nullable();
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
		Schema::drop('jobs_pictures');
	}

}
