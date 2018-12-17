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
            $table->date('date');
            $table->boolean('kept')->default(true);
            $table->boolean('open')->default(true);   
            $table->timestamps();
                        
            $table->integer('table_id')->unsigned();            
            $table->foreign('table_id')->references('id')->on('tables')
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
        Schema::dropIfExists('services');
    }
}
