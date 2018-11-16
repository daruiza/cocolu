<?php

use Illuminate\Database\Seeder;

class AcountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('acounts')->insert(array(
			'name'=>'Basic',
			'tables'=>12,
			'products'=>48,
			'label'=>'{}'			
			)
		);
		\DB::table('acounts')->insert(array(
			'name'=>'Standar',
			'tables'=>48,
			'products'=>192,
			'label'=>'{}'			
			)
		);
		\DB::table('acounts')->insert(array(
			'name'=>'Premium',
			'tables'=>92,
			'products'=>384,
			'label'=>'{}'			
			)
		);
    }
}
