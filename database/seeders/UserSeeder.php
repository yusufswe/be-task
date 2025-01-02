<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => Str::uuid(),
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'email' => 'admin@example.com',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'John Doe',
            'username' => 'johndoe',
            'password' => Hash::make('johndoe123'),
            'phone' => '987654321',
            'email' => 'johndoe@example.com',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => 'Jane Smith',
            'username' => 'janesmith',
            'password' => Hash::make('janesmith123'),
            'phone' => '555555555',
            'email' => 'janesmith@example.com',
        ]);
    }
}
