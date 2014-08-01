<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_orders', function(Blueprint $table)
		{
			$table->engine = "InnoDB";

			$table->increments('id');
			$table->integer('order_id');
			$table->integer('user_id');
			$table->integer("product_id");
			$table->integer('buyer_id');
			$table->integer("quantity");
			$table->float("price");
			$table->boolean('is_payment')->default('0');
			$table->boolean('is_shipping')->default('0');
			$table->boolean('is_checkout')->default('0');
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
		Schema::dropIfExists('product_orders');
	}

}
