<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsResumeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs_resume', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_id')->nullable();
	        $table->string('jobs_id');
	        $table->text('content');
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
		Schema::drop('jobs_comments');
	}

}
