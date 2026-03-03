<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@saas.com',
            'password' => Hash::make('Mmm123@#$m'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);
    }
}
