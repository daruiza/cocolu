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
            $table->string('nit',128)->nullable()->default(null);
            $table->string('department',128)->nullable()->default(null);
            $table->string('city',128)->nullable()->default(null);
            $table->string('adress',256)->nullable()->default(null);
            $table->string('description',512)->nullable()->default(null);
            $table->string('logo', 256)->default('default.png');
            $table->string('currency', 32)->default('COP');
            $table->string('label',1024)->nullable()->default('{"table":{"menu":"page","StoreHeight":"325","TableHeight":"120","icon":"fas fa-list","colorbody":"#f5f8fa","selectTable":"lemonchiffon","serviceOpenTable":"sandybrown","colorRow":"gainsboro","colorInactive":"black","graceTimeExpense":"15"},"order":{"OrderNew":"aliceblue","OrderOK":"cadetblue","OrderPay":"cornflowerblue","OrderCancel":"slategrey"},"order_status":{"OrderNew":"#4da9f9","OrderOK":"#3c6263","OrderPay":"#4167ab","OrderCancel":"#333a42"},"print":{"os":"0","conn":"/dev/usb/lp2"},"behavior":{"status_server":"0","view_room":"advance"}}');
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
