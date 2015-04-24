<?php

Class UserTableSeeder extends Seeder{

	public function run()
	{
		DB::table('users')->delete();
		
		User::create(array(
				'name' => 'Armando',
				'last_name' => 'Jacobo',
				'email' => 'armando_chivas123@hotmail.com',
				'username' => 'Admin',
				'password' => Hash::make('123'),
				'tipo' => '1'));
		//Otro

		User::create(array(
				'name' => 'Adrian',
				'last_name' => 'Olvera',
				'email' => 'adrian@hotmail.com',
				'username' => 'adrian',
				'password' => Hash::make('456'),
				'tipo' => '2'));

			
	}
}