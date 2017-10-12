<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Chris Perko',
	        'email' => 'asutrane@gmail.com',
	        'password' => bcrypt('password')
        ]);
    }
}
