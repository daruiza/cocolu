<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('stocks')->insert(array(        	
			'volume'=>4500.00,									
			'shift'=>1,			
			'product_id' => 1,
            'rel_clousure_id' =>1
			)
		);

        \DB::table('stocks')->insert(array(         
            'volume'=>500.00,                                  
            'shift'=>1,         
            'product_id' =>2,
            'rel_clousure_id' =>1
            )
        );

        \DB::table('stocks')->insert(array(         
            'volume'=>45.00,                                  
            'shift'=>1,         
            'product_id' =>3,
            'rel_clousure_id' =>1
            )
        );

        \DB::table('stocks')->insert(array(         
            'volume'=>2000.00,                                  
            'shift'=>1,         
            'product_id' =>4,
            'rel_clousure_id' =>1
            )
        );

        \DB::table('stocks')->insert(array(         
            'volume'=>2000.00,                                  
            'shift'=>1,         
            'product_id' =>5,
            'rel_clousure_id' =>1
            )
        );

        \DB::table('stocks')->insert(array(         
            'volume'=>95.00,                                  
            'shift'=>1,         
            'product_id' =>6,
            'rel_clousure_id' =>1
            )
        );

        \DB::table('stocks')->insert(array(         
            'volume'=>95.00,                                  
            'shift'=>1,         
            'product_id' =>7,
            'rel_clousure_id' =>1
            )
        );
    }
}
