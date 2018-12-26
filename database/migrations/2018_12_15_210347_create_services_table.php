<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('description',512)->nullable()->default(null);
            $table->dateTime('date');
            $table->boolean('kept')->default(false);//reserved
            $table->boolean('open')->default(true);//one service open for table						
            $table->timestamps();
                        
            $table->integer('table_id')->unsigned();            
            $table->foreign('table_id')->references('id')->on('tables')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
			$table->integer('rel_waiter_id')->unsigned(); //relacion simbolica con un mesero
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
        Schema::dropIfExists('services');
    }
}
