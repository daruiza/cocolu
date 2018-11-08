<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cities')->insert(array(
			'code'=>1,
			'name'=>'MEDELLIN',
			'department_id'=>1			
			)
		);

		\DB::table('cities')->insert(array(
				'code' => 88,
				'name' => "BELLO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 129,
				'name' => "CALDAS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 266,
				'name' => "ENVIGADO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 890,
				'name' => "YOLOMBO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 390,
				'name' => "LA PINTADA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 321,
				'name' => "GUATAPE",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 353,
				'name' => "HISPANIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 190,
				'name' => "CISNEROS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 647,
				'name' => "SAN ANDRES DE CUERQUIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 809,
				'name' => "TITIRIBI",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 21,
				'name' => "ALEJANDRIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 30,
				'name' => "AMAGA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 31,
				'name' => "AMALFI",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 34,
				'name' => "ANDES",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 36,
				'name' => "ANGELOPOLIS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 44,
				'name' => "ANZA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 59,
				'name' => "ARMENIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 91,
				'name' => "BETANIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 93,
				'name' => "BETULIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 101,
				'name' => "CIUDAD BOLIVAR",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 113,
				'name' => "BURITICA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 125,
				'name' => "CAICEDO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 138,
				'name' => "CAÑASGORDAS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 209,
				'name' => "CONCORDIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 240,
				'name' => "EBEJICO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 282,
				'name' => "FREDONIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 284,
				'name' => "FRONTINO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 306,
				'name' => "GIRALDO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 347,
				'name' => "HELICONIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 364,
				'name' => "JARDIN",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 368,
				'name' => "JERICO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 411,
				'name' => "LIBORINA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 467,
				'name' => "MONTEBELLO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 576,
				'name' => "PUEBLORRICO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 591,
				'name' => "PUERTO TRIUNFO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 604,
				'name' => "REMEDIOS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 642,
				'name' => "SALGAR",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 656,
				'name' => "SAN JERONIMO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 658,
				'name' => "SAN JOSE DE LA MONTAÑA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 660,
				'name' => "SAN LUIS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 670,
				'name' => "SAN ROQUE",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 42,
				'name' => "SANTAFE DE ANTIOQUIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 690,
				'name' => "SANTO DOMINGO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 736,
				'name' => "SEGOVIA",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 761,
				'name' => "SOPETRAN",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 789,
				'name' => "TAMESIS",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 792,
				'name' => "TARSO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 847,
				'name' => "URRAO",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 858,
				'name' => "VEGACHI",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 885,
				'name' => "YALI",
				'department_id' => 1
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 26,
				'name' => "ALTAMIRA",
				'department_id' => 2
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 245,
				'name' => "EL CARMEN DE ATRATO",
				'department_id' => 2
		)
				);
		\DB::table('cities')->insert(array(
				'code' => 2000,
				'name' => "BOLOMBOLO",
				'department_id' => 1
		)
				);
    }
}
