<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->startingValue(0);
            $table->string('serial',200)->nullable();
            $table->string('name',200);
            $table->longText('details');
            $table->string('image',250);
            $table->string('flavor',200)->default('no')->nullable();
            $table->string('cflavor',200)->default('no')->nullable();
            $table->string('add_ons',200)->default('no')->nullable();
            $table->string('sd_paid',200)->default(0)->nullable();
            $table->string('vat',200)->default(0)->nullable();
            $table->string('sd_drink',200)->default(0)->nullable();
            $table->string('rate',100)->default(0)->nullable();
            $table->string('status',100);

            $table->unsignedInteger('category_id');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
