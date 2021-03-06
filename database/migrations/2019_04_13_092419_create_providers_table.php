<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number',128);
            $table->string('name',128);
            $table->string('description',256)->nullable();
            $table->string('logo', 128)->default('default.png');
            $table->string('address', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->string('phone', 32)->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('providers');
    }
}
