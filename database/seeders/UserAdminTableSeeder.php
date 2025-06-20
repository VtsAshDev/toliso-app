<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@toliso.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'telephone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date(),
            'remember_token' => Str::random(10),
        ]);

    }
}
