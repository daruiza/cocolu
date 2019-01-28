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
            $table->string('description',512)->nullable()->default(null);
            $table->dateTime('date');
            $table->boolean('active')->default(true);            
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
