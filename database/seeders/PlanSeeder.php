<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Free',
                'slug' => 'free',
                'description' => 'Perfect for small teams getting started.',
                'price_monthly' => 0,
                'price_yearly' => 0,
                'currency' => 'USD',
                'max_employees' => 5,
                'duration_days' => 30,
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 1,
                'features' => [
                    ['feature_key' => 'max_employees', 'feature_value' => '5', 'label' => '5 Employees'],
                    ['feature_key' => 'basic_reporting', 'feature_value' => 'yes', 'label' => 'Basic Reporting'],
                ]
            ],
            [
                'name' => 'Professional',
                'slug' => 'professional',
                'description' => 'Advanced features for growing businesses.',
                'price_monthly' => 49,
                'price_yearly' => 490,
                'currency' => 'USD',
                'max_employees' => 50,
                'duration_days' => 30,
                'is_active' => true,
                'is_featured' => true,
                'sort_order' => 2,
                'features' => [
                    ['feature_key' => 'max_employees', 'feature_value' => '50', 'label' => '50 Employees'],
                    ['feature_key' => 'advanced_reporting', 'feature_value' => 'yes', 'label' => 'Advanced Reporting'],
                    ['feature_key' => 'priority_support', 'feature_value' => 'yes', 'label' => 'Priority Support'],
                ]
            ],
            [
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'description' => 'Scalable solution for large enterprises.',
                'price_monthly' => 199,
                'price_yearly' => 1990,
                'currency' => 'USD',
                'max_employees' => 0, // Unlimited
                'duration_days' => 30,
                'is_active' => true,
                'is_featured' => false,
                'sort_order' => 3,
                'features' => [
                    ['feature_key' => 'max_employees', 'feature_value' => 'Unlimited', 'label' => 'Unlimited Employees'],
                    ['feature_key' => 'custom_reporting', 'feature_value' => 'yes', 'label' => 'Custom Reporting'],
                    ['feature_key' => 'dedicated_manager', 'feature_value' => 'yes', 'label' => 'Dedicated Account Manager'],
                ]
            ],
        ];

        foreach ($plans as $planData) {
            $features = $planData['features'];
            unset($planData['features']);

            $plan = Plan::create($planData);

            foreach ($features as $feature) {
                $plan->features()->create($feature);
            }
        }
    }
}
