<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('serial')->unsigned();     
            $table->string('description',2048)->nullable()->default(null);
            $table->dateTime('date');
            $table->boolean('active')->default(true);            
            $table->integer('status_id')->unsigned()->default(1);          
            $table->foreign('status_id')->references('id')->on('order_status');
            $table->integer('waiter_id')->unsigned();     
            $table->foreign('waiter_id')->references('id')->on('waiters');
            $table->integer('service_id')->unsigned();            
            $table->foreign('service_id')->references('id')->on('services')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
