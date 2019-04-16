<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price')->default(0);
            $table->float('volume')->default(0);
            $table->integer('invoice_id')->unsigned();            
            $table->foreign('invoice_id')->references('id')->on('invoices');            
            $table->integer('product_id')->unsigned();            
            $table->foreign('product_id')->references('id')->on('products');            
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
