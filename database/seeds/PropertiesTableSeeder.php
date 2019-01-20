<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('properties')->insert([
			'address_line_1' => "3 Abbey Rd",
			'address_line_2' => "",
			'city_id' => 1,
			'postcode' => "NW8 9AY",
		]);
	}	
}
