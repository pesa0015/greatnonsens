<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'username' => 'Pretend',
        	'email' => 'peters945@hotmail.com',
        	'password' => bcrypt('secret'),
        	'is_guest' => 0
        ]);
    }
}
