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
			'name'=>'unidad',
            'contract'=>'un',			
			)
		);
        \DB::table('unities')->insert(array(            
            'name'=>'kilo',         
            'contract'=>'kl',
            )
        );
        \DB::table('unities')->insert(array(            
            'name'=>'libra' ,        
            'contract'=>'lb',
            )
        );
        \DB::table('unities')->insert(array(            
            'name'=>'gramo' ,        
            'contract'=>'gr',
            )
        );
        \DB::table('unities')->insert(array(            
            'name'=>'litro'  ,       
            'contract'=>'lr',
            )
        );
		\DB::table('unities')->insert(array(			
			'name'=>'litro',		
            'contract'=>'lr',
			)
		);
        \DB::table('unities')->insert(array(            
            'name'=>'mililitro',         
            'contract'=>'ml',
            )
        );
    }
}
