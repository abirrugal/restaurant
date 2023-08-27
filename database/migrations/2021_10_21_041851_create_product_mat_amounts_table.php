<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMatAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_mat_amounts', function (Blueprint $table) {
            $table->increments('id')->startingValue(0);
            $table->string('material_name',250);
            $table->string('amount')->default(0)->nullable();
            $table->string('unit')->nullable();
            $table->unsignedInteger('product_mat_setting_id');

            $table->foreign('product_mat_setting_id')->references('id')->on('product_mat_settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_mat_amounts');
    }
}
