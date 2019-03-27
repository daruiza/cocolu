<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClousuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clousures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('description',512)->nullable()->default(null);
            $table->boolean('open')->default(true);//one clousere open for session
            $table->dateTime('date_open')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('date_close');

            $table->integer('store_id')->unsigned();            
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
        Schema::dropIfExists('clousures');
    }
}
