<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('description',512)->nullable()->default(null);
            $table->string('icon', 32)->default(null);
            $table->string('label', 512)
                ->nullable()
                ->default('{"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["","","",""],"logo":"table.png","icon":"fas fa-list"}');            
            $table->string('order', 16)->default(1);
            $table->boolean('active')->default(true);         
            $table->timestamps();

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
        Schema::dropIfExists('tables');
    }
}
