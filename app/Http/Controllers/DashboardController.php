<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $stats = [
            'total_companies' => \App\Models\Company::count(),
            'total_users' => \App\Models\User::count(),
            'total_plans' => \App\Models\Plan::count(),
            'active_subscriptions' => \App\Models\Subscription::where('status', 'active')->count(),
            'total_revenue' => \App\Models\Subscription::where('status', 'active')->sum('price_paid'),
        ];

        $recent_companies = \App\Models\Company::latest()->take(5)->get();
        $recent_users = \App\Models\User::with('company')->latest()->take(5)->get();

        return view('pages.index', compact('stats', 'recent_companies', 'recent_users'));
    }
}
