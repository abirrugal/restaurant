<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id')->startingValue(0);
            $table->string('name');
            $table->string('qty');

            $table->string('rate');
            $table->string('vat')->nullable();
            $table->string('payable')->nullable();
           
            $table->string('order_sts')->nullable()->default('panding');
            $table->string('discount')->nullable();
            $table->string('flavor')->nullable();
            $table->string('cflavor')->nullable();

            $table->unsignedInteger('order_id');

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
 

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
        Schema::dropIfExists('order_products');
    }
}
