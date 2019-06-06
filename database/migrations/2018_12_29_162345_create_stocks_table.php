<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->float('volume');
            $table->boolean('shift')->default(false);
            $table->string('description',512)->nullable()->default(null);
            $table->dateTime('date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->integer('product_id')->unsigned()->default(1);            
            $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('rel_clousure_id')->unsigned(); //relacion simbolica con algun clousure, el clousure contiene el detalle
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
