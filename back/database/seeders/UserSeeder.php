<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'nick' => 'Admin',
            'email' => 'admin@gmail.com',
            "fechaLimite" => "2099-07-29",
            'password' => bcrypt('admin123Admin')
            ]);
    }
}
