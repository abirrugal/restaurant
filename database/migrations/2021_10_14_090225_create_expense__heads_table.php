<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense__heads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',250);
            $table->string('name',250);
            $table->longText('details');
            $table->decimal('amount',10 ,2);
            $table->string('status',250);

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
        Schema::dropIfExists('expense__heads');
    }
}
