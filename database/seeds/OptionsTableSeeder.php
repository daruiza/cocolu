<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('options')->insert(array(
			'name'=>'index',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-list"}',
			'module_id'=>1			
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'show',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-list"}',
			'module_id'=>1	
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'create',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-plus"}',
			'module_id'=>1	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'edit',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-cogs"}',
			'module_id'=>1	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'destroy',			
			'label'=>'{"menu":"page","method":"delete","icon":"fas fa-times-circle"}',
			'module_id'=>1	
			)
		);

		//Modulo Opciones
		\DB::table('options')->insert(array(
			'name'=>'index',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-list"}',
			'module_id'=>2			
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'show',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-list"}',
			'module_id'=>2	
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'create',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-plus"}',
			'module_id'=>2	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'edit',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-cogs"}',
			'module_id'=>2	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'destroy',			
			'label'=>'{"menu":"page","method":"delete","icon":"fas fa-times-circle"}',
			'module_id'=>2	
			)
		);


		//Modulo Table opt 11
		\DB::table('options')->insert(array(
			'name'=>'index',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-list"}',
			'module_id'=>6			
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'show',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-list"}',
			'module_id'=>6	
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'create',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-plus"}',
			'module_id'=>6	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'edit',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-cogs"}',
			'module_id'=>6
			)
		);			
		\DB::table('options')->insert(array(
			'name'=>'destroy',			
			'label'=>'{"menu":"page","method":"delete","icon":"fas fa-times-circle"}',
			'module_id'=>6
			)
		);

		\DB::table('options')->insert(array(
			'name'=>'drag',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-arrows-alt"}',
			'module_id'=>6
			)
		);
		
		\DB::table('options')->insert(array(
			'name'=>'service',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-clipboard"}',
			'module_id'=>6			
			)
		);	
		
		//Modulo Waiters opt 18
		\DB::table('options')->insert(array(
			'name'=>'index',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-list"}',
			'module_id'=>8		
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'show',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-list"}',
			'module_id'=>8	
			)
		);
		\DB::table('options')->insert(array(
			'name'=>'create',			
			'label'=>'{"menu":"top","method":"get","icon":"fas fa-plus"}',
			'module_id'=>8	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'edit',			
			'label'=>'{"menu":"page","method":"get","icon":"fas fa-cogs"}',
			'module_id'=>8	
			)
		);		
		\DB::table('options')->insert(array(
			'name'=>'destroy',			
			'label'=>'{"menu":"page","method":"delete","icon":"fas fa-times-circle"}',
			'module_id'=>8	
			)
		);
    }
}
