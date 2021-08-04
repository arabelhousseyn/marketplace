<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
            'fname' => 'Arab',
            'lname' => 'hocine',
            'email' => 'test2@test.com',
            'username' => 'hocine12',
            'phone' => '0699687499',
            'online' => 0,
            'statu' => 0,
            'password' => Hash::make('password')
        ]);
    }
}
