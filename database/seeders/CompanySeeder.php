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
                'name' => 'Acme Corp',
                'subdomain' => 'acme',
                'email' => 'contact@acme.com',
                'phone1' => '123456789',
                'status' => 'active',
            ],
            [
                'name' => 'Global Tech',
                'subdomain' => 'global',
                'email' => 'info@globaltech.com',
                'phone1' => '987654321',
                'status' => 'active',
            ],
            [
                'name' => 'Startup Hub',
                'subdomain' => 'startup',
                'email' => 'hello@startuphub.io',
                'phone1' => '555444333',
                'status' => 'trial',
                'trial_ends_at' => Carbon::now()->addDays(14),
            ],
        ];

        foreach ($companies as $index => $companyData) {
            $company = Company::create($companyData);

            // Assign a plan to each company
            $plan = $plans[$index % count($plans)];

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
