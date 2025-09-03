<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

 


class UserSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password12345'),  
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}