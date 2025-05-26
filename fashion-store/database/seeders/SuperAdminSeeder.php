<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'anas@anas.com',
            'password' => Hash::make('Heba1234'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
            'is_designer' => false,
        ]);
    }
}