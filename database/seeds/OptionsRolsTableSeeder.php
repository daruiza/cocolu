<?php

use Illuminate\Database\Seeder;

class OptionsRolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>1			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>2			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>3			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>4			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>5
			)
		);


		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>6			
			)
		);	
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>7			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>8			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>9			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>1,			
			'option_id'=>10			
			)
		);

		//administrador 
		\DB::table('option_rol')->insert(array(
			'rol_id'=>2,			
			'option_id'=>11			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>2,			
			'option_id'=>12
			)
		);	
		\DB::table('option_rol')->insert(array(
			'rol_id'=>2,			
			'option_id'=>13			
			)
		);	
		\DB::table('option_rol')->insert(array(
			'rol_id'=>2,			
			'option_id'=>14			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>2,			
			'option_id'=>15			
			)
		);
		\DB::table('option_rol')->insert(array(
			'rol_id'=>2,			
			'option_id'=>16			
			)
		);
		

		
    }
}
