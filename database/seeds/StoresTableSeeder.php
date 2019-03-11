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
			'label'=>'{"menu":"page","icon":"fas fa-list","selectTable":"lemonchiffon","serviceOpenTable":"sandybrown","colorRow":"gainsboro","OrderStatusOne":"cadetblue"}',
			)
		);		
    }
}
