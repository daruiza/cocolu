<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',16);
            $table->string('surname', 32)->nullable();
            $table->string('email', 128)->unique();
            $table->string('phone', 32)->nullable();
            $table->string('avatar', 128)->default('default.png');         
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->integer('rol_id')->unsigned()->default(2);            
            $table->foreign('rol_id')->references('id')->on('rols')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('acount_id')->unsigned()->default(1);            
            $table->foreign('acount_id')->references('id')->on('acounts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('rel_store_id')->unsigned(); //relación simbolica con alguna store, el tipo de cuenta determina la store
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
