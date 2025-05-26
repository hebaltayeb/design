<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DesignerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Designer User',
            'email' => 'designer@designer.com',
            'password' => Hash::make('123456'),
            'role' => 'designer',
            'email_verified_at' => now(),
            'is_designer' => true,
        ]);
    }
}