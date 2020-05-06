<?php

use Illuminate\Database\Seeder;

class WaitersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('waiters')->insert(array(
			'description'=>'',
			'label'=>'',						
			'user_id'=>3
			)
        );
        
        \DB::table('waiters')->insert(array(
			'description'=>'',
			'label'=>'',						
			'user_id'=>4
			)
		);
		
    }
}
