<?php

use Illuminate\Database\Seeder;

class UnitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('unities')->insert(array(			
			'name'=>'ANTIOQUIA'			
			)
		);
		\DB::table('unities')->insert(array(			
			'name'=>'HUILA'			
			)
		);
    }
}
