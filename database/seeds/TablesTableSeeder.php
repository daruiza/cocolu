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
			'name'=>'Afuera 1',
			'description'=>'Description',
			'icon' => 'fas fa-beer',
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',
			'store_id'=>1,			
			)
		);

		\DB::table('tables')->insert(array(        	
			'name'=>'Afuera 2',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);		

		\DB::table('tables')->insert(array(        	
			'name'=>'Barra 1',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',
			'store_id'=>1,			
			)
		);

		\DB::table('tables')->insert(array(        	
			'name'=>'Barra 2',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'Barra',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'Mesa 1',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);						
		\DB::table('tables')->insert(array(        	
			'name'=>'Mesa 2',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'Mesa 3',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'Mesa 4',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
    }
}
