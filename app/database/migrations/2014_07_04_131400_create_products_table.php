<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
	        $table->string('user_id');
	        $table->string('post_status')->default('close');
	        $table->string('thumbnails')->nullable();
	        $table->string('category_id');
	        $table->string('price',100);
	        $table->string('quantity',100)->nullable();
	        $table->text('title', 100);
	        $table->text('slug', 255);
	        $table->text('province')->nullable();
	        $table->text('city')->nullable();
	        $table->text('content');
	        $table->text('meta_title', 100);
	        $table->text('meta_description', 255);
	        $table->text('meta_keywords', 255);
	        $table->smallInteger('comments_count')->default('0');
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
		Schema::drop('products');
	}

}
