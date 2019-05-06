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
            $table->string('number',128);
            $table->string('description',256)->nullable();
            $table->string('support', 128)->default('default.png');
            $table->float('tax')->nullable()->default(0);
            $table->integer('provider_id')->unsigned();            
            $table->foreign('provider_id')->references('id')->on('providers')
            ->onDelete('cascade')
            ->onUpdate('cascade'); 
            $table->integer('store_id')->unsigned();        
            $table->foreign('store_id')->references('id')->on('stores')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('clousure_id')->unsigned();            
            $table->foreign('clousure_id')->references('id')->on('clousures')->onDelete('cascade')
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
