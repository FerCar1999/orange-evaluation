<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            [
                'name' => 'Fernando Carranza',
                'phone' => '79862231',
                'username' => 'fercarranza99',
                'birthday' => '1999-05-25',
                'email' => 'carranzafernando99@gmail.com',
                'password' => bcrypt("fer12345"),
            ]
        ]);
    }
}
