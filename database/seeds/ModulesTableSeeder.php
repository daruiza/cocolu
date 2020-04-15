<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('modules')->insert(array(
			'name'=>'Rols',
			'description'=>'ModuleRols',
			'label'=>'{"action":"rol","maticon":"fiber_manual_record"}'			
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Modules',
			'description'=>'ModuleModules',
			'label'=>'{"action":"module","maticon":"fiber_manual_record"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Options',
			'description'=>'ModuleOptions',
			'label'=>'{"action":"option","maticon":"fiber_manual_record"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Users',
			'description'=>'ModuleUsers',
			'label'=>'{"action":"user","maticon":"fiber_manual_record"}'
			)
		);	
		\DB::table('modules')->insert(array(
			'name'=>'Stores',
			'description'=>'ModuleStores',
			'label'=>'{"action":"store","maticon":"fiber_manual_record"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Tables',
			'description'=>'ModuleTables',
			'label'=>'{"action":"table","maticon":"dashboard"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Services',
			'description'=>'ModuleServices',
			'label'=>'{"action":"service","maticon":"fiber_manual_record"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Waiters',
			'description'=>'ModuleWaiters',
			'label'=>'{"action":"waiter","maticon":"perm_contact_calendar"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Products',
			'description'=>'ModuleProducts',
			'label'=>'{"action":"product","maticon":"bookmarks"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Categories',
			'description'=>'ModuleCategories',
			'label'=>'{"action":"category","maticon":"apps"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Expenses',
			'description'=>'ModuleExtpenses',
			'label'=>'{"action":"expense","maticon":"trending_down"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Invoices',
			'description'=>'ModuleInvoices',
			'label'=>'{"action":"invoice","maticon":"assignment"}'
			)
		);
		
    }
}