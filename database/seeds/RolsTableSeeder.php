<?php

use Illuminate\Database\Seeder;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rols')->insert(array(
			'name'=>'Super-Administrador',
			'description'=>'superAdmin',
			'label'=>'{"options":["editProfile","passwordChange","acountSummary","termsConditions"]}'			
			)
		);
		\DB::table('rols')->insert(array(
			'name'=>'Administrador',
			'description'=>'admin',
			'label'=>'{"options":["editProfile","editStore","workClousure","passwordChange","acountSummary","sendSuggestions","termsConditions"]}'
			)
		);
		\DB::table('rols')->insert(array(
			'name'=>'Agente',
			'description'=>'adminMeans',
			'label'=>'{"options":["editProfile","passwordChange","acountSummary","sendSuggestions","termsConditions"]}'
			)
		);
    }
}
