<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'lastname' => 'Istrtor',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('administrator'),
            'role' => 1,  
        ]);
    }
}
