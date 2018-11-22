<?php

use Illuminate\Database\Seeder;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tables')->insert(array(        	
			'name'=>'Default',
			'description'=>'Description',			
			'label'=>'{"options":["addTable","editTable"],"logo":"table.png","icon":"fas fa-list"}',		
			'store_id'=>1,			
			)
		);

		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable',
			'description'=>'DescriptionTable',			
			'label'=>'{"options":["addTable","editTable"],"logo":"table.png","icon":"fas fa-list"}',			
			'store_id'=>1,			
			)
		);		
    }
}
