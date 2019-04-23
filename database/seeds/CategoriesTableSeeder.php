<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert(array(
			'name'=>'Cocolu',
			'rel_store_id' => 1				
			)
		);
		\DB::table('categories')->insert(array(
			'name'=>'Gaseosas',
			'category_id' => 1,
			'rel_store_id' => 1
			)
		);
		\DB::table('categories')->insert(array(
			'name'=>'Alcohol',
			'category_id' => 1,
			'rel_store_id' => 1
			)
		);
		\DB::table('categories')->insert(array(
			'name'=>'Cocteles',
			'category_id' => 1,
			'rel_store_id' => 1	
			)
		);

    }
}
