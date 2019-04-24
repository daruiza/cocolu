<?php

use Illuminate\Database\Seeder;

class ProductProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_product')->insert(array(
			'product_id'=>8,
			'ingredient_id' => 1,
			'volume'=>5,
			'group'=>null,
			)
		);

		\DB::table('product_product')->insert(array(
			'product_id'=>8,
			'ingredient_id' => 3,
			'volume'=>0.5,
			'group'=>null,
			)
		);

		\DB::table('product_product')->insert(array(
			'product_id'=>8,
			'ingredient_id' => 4,
			'volume'=>1,
			'group'=>'Sabor',
			)
		);

		\DB::table('product_product')->insert(array(
			'product_id'=>8,
			'ingredient_id' => 5,
			'volume'=>1,
			'group'=>'Sabor',
			)
		);

		\DB::table('product_product')->insert(array(
			'product_id'=>8,
			'ingredient_id' => 6,
			'volume'=>1,
			'group'=>'Cerveza',
			)
		);

		\DB::table('product_product')->insert(array(
			'product_id'=>8,
			'ingredient_id' => 7,
			'volume'=>1,
			'group'=>'Cerveza',
			)
		);
		

    }
}
