<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $plans = Plan::all();

        $companies = [
            [
                'name' => 'EraaSoft',
                'uid' => \Illuminate\Support\Str::uuid()->toString(),
                'admin_name' => 'Mostafa Mahfouz',
                'admin_email' =>'mostafa@eraasoft.com',
                'subdomain' => 'http://127.0.0.1:8000',
                'email' => 'info@eraasoft.com',
                'phone1' => '+201001234567',
                'phone2' => '+201001234567',
                'address' => '13th floor, 5 Messadak St, Dokki, Giza, Egypt',
                'status' => 'active',
            ],
        ];

        foreach ($companies as $index => $companyData) {
            $admin = \App\Models\User::create([
                'name' => $companyData['admin_name'],
                'email' => $companyData['admin_email'],
                'phone' => $companyData['phone1'],
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => 'company_admin',
            ]);
            $companyData['user_id'] = $admin->id;
            unset($companyData['admin_name'], $companyData['admin_email']);
            $company = Company::create($companyData);
            // Assign a plan to each company
            $plan = $plans[$index % count($plans)];
            $company->current_plan_id = $plan->id;
            $company->save();

            Subscription::create([
                'company_id' => $company->id,
                'plan_id' => $plan->id,
                'status' => 'active',
                'billing_cycle' => 'monthly',
                'price_paid' => $plan->price_monthly,
                'currency' => $plan->currency,
                'starts_at' => Carbon::now(),
                'ends_at' => Carbon::now()->addDays($plan->duration_days),
            ]);
        }
    }
}
