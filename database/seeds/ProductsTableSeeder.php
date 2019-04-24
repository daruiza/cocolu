<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert(array(
			'name'=>'Sal',
			'price'=>0,
			'buy_price'=>1200,
			'volume'=>4500.00,
			'critical_volume'=>1000,
			'description'=>'Producto básico',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>1,
			'label'=>'{}',			
			'unity_id'=>4,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Pimienta',
			'price'=>0,
			'buy_price'=>3200,
			'volume'=>500.00,
			'critical_volume'=>200,
			'description'=>'Producto básico',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>2,
			'label'=>'{}',			
			'unity_id'=>4,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Limón',
			'price'=>0,
			'buy_price'=>1800,
			'volume'=>45.00,
			'critical_volume'=>20,
			'description'=>'Producto básico',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>3,
			'label'=>'{}',			
			'unity_id'=>1,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Maracuya',
			'price'=>0,
			'buy_price'=>12000,
			'volume'=>2000.00,
			'critical_volume'=>500,
			'description'=>'Producto básico Sabor',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>4,
			'label'=>'{}',			
			'unity_id'=>5,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Triple Sec',
			'price'=>0,
			'buy_price'=>12000,
			'volume'=>2000.00,
			'critical_volume'=>500,
			'description'=>'Producto básico Sabor',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>5,
			'label'=>'{}',			
			'unity_id'=>5,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Pilsen',
			'price'=>3000,
			'buy_price'=>1700,
			'volume'=>95.00,
			'critical_volume'=>45,
			'description'=>'',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>6,
			'label'=>'{}',			
			'unity_id'=>1,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Aguila Ligth',
			'price'=>3000,
			'buy_price'=>1700,
			'volume'=>95.00,
			'critical_volume'=>45,
			'description'=>'',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>7,
			'label'=>'{}',			
			'unity_id'=>1,
			'store_id'=>1
			)
		);

		\DB::table('products')->insert(array(
			'name'=>'Michelada',
			'price'=>3500,
			'buy_price'=>0,
			'volume'=>0,
			'critical_volume'=>0,
			'description'=>'',
			'image1'=>'default.png',
			'image2'=>'default.png',
			'image3'=>'default.png',
			'order'=>8,
			'label'=>'{}',			
			'unity_id'=>1,
			'store_id'=>1
			)
		);

    }
}
