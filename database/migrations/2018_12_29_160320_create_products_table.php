<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('name',128);
            $table->integer('price')->default(0);
            $table->integer('buy_price')->default(0);
            $table->integer('volume')->default(0);
            $table->integer('critical_volume')->default(0);
            $table->string('description',512)->nullable()->default(null);
            $table->string('image1', 128)->default('default.png');         
            $table->string('image2', 128)->default('default.png');         
            $table->string('image3', 128)->default('default.png');  
            $table->string('order', 16)->default(1);
            $table->string('label', 128)->nullable()->default('{}');     
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->integer('unity_id')->unsigned()->default(1);            
            $table->foreign('unity_id')->references('id')->on('unities');            
            $table->integer('store_id')->unsigned()->default(2);        
            $table->foreign('store_id')->references('id')->on('stores')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
