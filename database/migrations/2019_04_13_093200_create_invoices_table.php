<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number',128)->nullable();
            $table->string('description',256);
            $table->string('support', 128);
            $table->float('tax')->default(0);
            $table->integer('provider_id')->unsigned();            
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->integer('store_id')->unsigned()->default(2);        
            $table->foreign('store_id')->references('id')->on('stores')
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
        Schema::dropIfExists('invoices');
    }
}
