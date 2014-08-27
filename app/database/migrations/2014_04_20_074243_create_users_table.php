<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email');
	        $table->string('password');
	        $table->string('username', 60)->nullable();
	        $table->string('nickname', 60)->nullable();
	        $table->string('sex',4)->nullable();
	        $table->text('bio')->nullable();
	        $table->string('born_year')->nullable();
	        $table->string('born_month')->nullable();
	        $table->string('born_day')->nullable();
	        $table->text('home_province')->nullable();
	        $table->text('home_city')->nullable();
	        $table->text('home_address')->nullable();
	        $table->string('bound_type')->default('0');
	        $table->string('alipay')->nullable();
	        $table->string('phone')->nullable();
	        $table->string('portrait')->nullable();
	        $table->string('remember_token')->nullable();
	        $table->boolean('is_admin')->default('0');
	        $table->timestamp('deleted_at')->nullable();
	        $table->timestamp('activated_at')->nullable();
	        $table->timestamp('signin_at')->nullable();
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
		Schema::drop('users');
	}

}
