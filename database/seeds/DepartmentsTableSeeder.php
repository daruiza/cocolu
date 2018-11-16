<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('departments')->insert(array(
			'code'=>5,
			'name'=>'ANTIOQUIA'			
			)
		);
		\DB::table('departments')->insert(array(
			'code'=>41,
			'name'=>'HUILA'			
			)
		);
    }
}
