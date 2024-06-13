<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'idex admin',
                'email' => 'admin@idex.com',
                'password' => Hash::make('password@123'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'phone' => null,
                'image' => 'images/logoidex.png',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Sam NJT',
                'email' => 'Sam@exampleidex.com',
                'password' => Hash::make('ss123123'),
                'role' => 'user',
                'image' => 'images/logoidex.png',
                 'email_verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'phone' => null,
                 'remember_token' => Str::random(10),
            ],
        ]);
    }
}