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
			'name'=>'DefaultTable Name Long',
			'description'=>'Description',
			'icon' => 'fas fa-beer',
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',
			'store_id'=>1,			
			)
		);

		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);		

		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable2',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',
			'store_id'=>1,			
			)
		);

		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable3',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable4',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',			
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable5',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);						
		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable6',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable7',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
		\DB::table('tables')->insert(array(        	
			'name'=>'DefaultTable8',
			'description'=>'DescriptionTable',
			'icon' => 'fas fa-beer',		
			'label'=>'{	"options":["serviceCreate","orderCreate","qrcodeGenerate"],"position":["top","right","bottom","left"],"logo":"table.png","icon":"fas fa-list"}',	
			'store_id'=>1,			
			)
		);
    }
}
