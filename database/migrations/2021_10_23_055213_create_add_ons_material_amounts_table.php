<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddOnsMaterialAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_ons_material_amounts', function (Blueprint $table) {
            $table->increments('id')->startingValue(0);
            $table->string('material_name',250);
            $table->string('amount')->default(0)->nullable();
            $table->string('unit')->nullable();
            $table->unsignedInteger('add_ons_mat_setting_id');

            $table->foreign('add_ons_mat_setting_id')->references('id')->on('add_ons_material_settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_ons_material_amounts');
    }
}
