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
			'label'=>'{"action","rol"}'			
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Modules',
			'description'=>'ModuleModules',
			'label'=>'{"action","module"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Options',
			'description'=>'ModuleOptions',
			'label'=>'{"action","option"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Users',
			'description'=>'ModuleUsers',
			'label'=>'{"action","user"}'
			)
		);	
		\DB::table('modules')->insert(array(
			'name'=>'Stores',
			'description'=>'ModuleStores',
			'label'=>'{"action","store"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Tables',
			'description'=>'ModuleTables',
			'label'=>'{"action","table"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Services',
			'description'=>'ModuleServices',
			'label'=>'{"action","service"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Waiters',
			'description'=>'ModuleWaiters',
			'label'=>'{"action","waiter"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Products',
			'description'=>'ModuleProducts',
			'label'=>'{"action","product"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Categories',
			'description'=>'ModuleCategories',
			'label'=>'{"action","category"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Expenses',
			'description'=>'ModuleExtpenses',
			'label'=>'{"action","expense"}'
			)
		);
		\DB::table('modules')->insert(array(
			'name'=>'Invoices',
			'description'=>'ModuleInvoices',
			'label'=>'{"action","invoice"}'
			)
		);
		
    }
}
