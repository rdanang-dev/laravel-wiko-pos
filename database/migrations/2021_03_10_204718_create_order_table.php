<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('order_code');
            $table->integer('order_number')->default(0);
            $table->text('notes')->nullable();
            $table->bigInteger('total_price')->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();

            $table->foreign('employee_id')->on('users')->references('id');
        });

        Schema::create('order_details',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menu_id');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('discount')->default(0);
            $table->bigInteger('qty')->default(0);
            $table->timestamps();


            $table->foreign('order_id')->on('orders')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('menu_id')->on('menus')->references('id')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders',function(Blueprint $table){
            $table->dropForeign(['employee_id']);
        });

        Schema::table('order_details',function(Blueprint $table){
            $table->dropForeign(['order_id']);
            $table->dropForeign(['menu_id']);
        });

        Schema::dropIfExists('orders');



        Schema::dropIfExists('order_details');
    }
}
