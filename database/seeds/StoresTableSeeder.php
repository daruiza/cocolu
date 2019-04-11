<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('stores')->insert(array(        	
			'name'=>'Default',
			'department'=>'Antioquia',
			'city'=>'Medellín',
			'adress'=>'Cr 1 - 1 # 1',
			'description'=>'default store',
			'logo'=>'default.png',
			'currency'=>'COP',
			'label'=>'{"table":{"menu":"page","TableHeight":"125","icon":"fas fa-list","selectTable":"lemonchiffon","serviceOpenTable":"sandybrown","colorRow":"gainsboro","graceTimeExpense":"3"},"order":{"OrderNew":"aliceblue","OrderOK":"cadetblue","OrderPay":"cornflowerblue","OrderCancel":"slategrey"},"order_status":{"OrderNew":"#4da9f9","OrderOK":"#3c6263","OrderPay":"#4167ab","OrderCancel":"#333a42"}}',
			)
		);		
    }
}