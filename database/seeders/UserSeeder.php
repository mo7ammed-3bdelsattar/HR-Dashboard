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
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // 2. Create Company Admins for each seeded company
        $companies = Company::all();

        foreach ($companies as $company) {
            User::create([
                'name' => $company->name . ' Admin',
                'email' => 'admin@' . $company->subdomain . '.com',
                'password' => Hash::make('password'),
                'company_id' => $company->id,
                'role' => 'company_admin',
                'is_active' => true,
            ]);
        }
    }
}
