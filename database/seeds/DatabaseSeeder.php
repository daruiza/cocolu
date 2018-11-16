<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       	$this->call(RolsTableSeeder::class);    	
        $this->call(ModulesTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(OptionsRolsTableSeeder::class);
        $this->call(AcountsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
    }
}
