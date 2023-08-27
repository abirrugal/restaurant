<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw__materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',250);
            $table->string('unit');
            $table->string('use_unit');
            $table->string('unit_use_unit');
            $table->decimal('rate',10,2);
            $table->string('alert_qty');
            $table->string('status');
         

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
        Schema::dropIfExists('raw__materials');
    }
}
