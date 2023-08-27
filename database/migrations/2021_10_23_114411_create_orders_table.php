<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->startingValue(0);
// Order Info 
         
            $table->string('parcel_status')->nullable();
            $table->string('fund')->nullable();

           
       
//For panding order

            $table->string('kitchen_id')->nullable();
            $table->string('waiter_id')->nullable();
            $table->string('token')->nullable();
            $table->string('table_no')->nullable();
            $table->string('sale_status')->nullable();
            $table->longText('note')->nullable();

            
//For advanced delivery

            $table->string('delivery_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_number')->nullable();
            $table->longText('customer_address')->nullable();
            $table->string('total')->nullable();
            $table->string('total_with_discount')->nullable();
            
            $table->string('total_rate')->nullable();
            $table->string('total_vat')->nullable();
            $table->string('percent_discount')->nullable();
            $table->string('total_discount')->nullable();
            $table->string('total_payment')->nullable();


            //Order normal or Advanced
            $table->string('order_status')->nullable();      
            $table->string('order_type')->nullable();      

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
        Schema::dropIfExists('orders');
    }
}
