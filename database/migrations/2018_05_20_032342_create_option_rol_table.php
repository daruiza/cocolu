<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionRolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_rol', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('rol_id')->unsigned();            
            $table->integer('option_id')->unsigned();       
            $table->foreign('rol_id')->references('id')->on('rols') ->onDelete('cascade')
            ->onUpdate('cascade');           
            $table->foreign('option_id')->references('id')->on('options') ->onDelete('cascade')
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
        Schema::dropIfExists('option_rol');
    }
}
