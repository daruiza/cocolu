<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128)->nullable()->default(null);
            $table->string('department',128)->nullable()->default(null);
            $table->string('city',128)->nullable()->default(null);
            $table->string('adress',256)->nullable()->default(null);
            $table->string('description',512)->nullable()->default(null);
            $table->string('logo', 256)->default('default.png');
            $table->string('currency', 32)->default('COP');
            $table->string('label')->nullable()->default('{"menu":"page","icon":"fas fa-list","selectTable":"lemonchiffon","serviceOpenTable":"sandybrown"}');
            $table->boolean('active')->default(true);            
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
        Schema::dropIfExists('stores');
    }
}
