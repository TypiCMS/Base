<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;

class UserSeeder extends Seeder {

	public function run()
	{

		\App\User::create([
		'email' => 'admin@example.com',
		'password' => bcrypt('admin'),
		'permissions' => '{"superuser":1}',
		'activated' => 'TRUE',
		'activation_code' => NULL,
		'activated_at' => NULL,
		'last_login' => NULL,
		'persist_code' => NULL,
		'reset_password_code' => NULL,
		'first_name' => 'Demo',
		'last_name' => 'User',
		'preferences' => NULL,
		]);

	}

}
