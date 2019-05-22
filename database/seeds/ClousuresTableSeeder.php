<?php

use Illuminate\Database\Seeder;

class ClousuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('clousures')->insert(array(        	
			'name'=>'Init',									
			'description'=>'default Clousure',
			'open' => true,
			'store_id' => 1
			)
		);		
    }
}
