<?php

use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('order_status')->insert(array(
			'name'=>'OrderNew'				
			)
		);
		\DB::table('order_status')->insert(array(
			'name'=>'OrderOK'						
			)
		);
		\DB::table('order_status')->insert(array(
			'name'=>'OrderPay'						
			)
		);
		\DB::table('order_status')->insert(array(
			'name'=>'OrderCancel'						
			)
		);

    }
}
