<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create a test user
        User::create([
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'address' => null, // Will be filled by user
            'phone_num' => null, // Will be filled by user
            'role' => 'Customer',
        ]);

        // Create another test user
        User::create([
            'username' => 'naomi',
            'email' => 'water.melon@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Jl. Sudirman No. 123, Jakarta',
            'city' => 'DKI Jakarta',
            'district' => 'Johar Baru',
            'postal_code' => '10230',
            'phone_num' => '+62 812 3456 7890',
            'role' => 'Customer',
        ]);
    }
}
