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
            $table->text('order_id');
            $table->text('alipay_trade')->nullable();;
            $table->integer('seller_id');
            $table->integer("product_id");
            $table->integer('customer_id');
            $table->integer("quantity");
            $table->string("price", 60);
            $table->string("payment", 60);
            $table->text("customer_address", 120);
            $table->text("express_name", 120)->nullable();
            $table->text("invoice_no", 120)->nullable();
            $table->boolean('is_payment')->default('0');
            $table->boolean('is_express')->default('0');
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
