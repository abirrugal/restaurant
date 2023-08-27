<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id')->startingValue(0);
            $table->string('fund')->nullable();
            $table->string('date')->nullable();


            $table->string('total_rate')->nullable();
            $table->string('total_discount')->nullable();
            $table->string('total_with_discount')->nullable();
            $table->string('total_payment')->nullable();
            //Panding or completed
            $table->string('purchase_status')->nullable();   
            //Restaurant or Factory
            $table->string('purchase_type')->nullable();   

            $table->string('supplier_company', 200)->nullable();
            $table->string('supplier_name', 200)->nullable();  
            $table->longText('supplier_address', 200)->nullable();
            $table->longText('supplier_invoice', 200)->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
