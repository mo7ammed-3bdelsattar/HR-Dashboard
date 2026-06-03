<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Company;
use App\Models\Plan;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\SubscriptionHistory;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::with(['company', 'plan'])->latest()->paginate(10);
        return view('pages.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $companies = Company::all();
        $plans = Plan::where('is_active', true)->get();
        return view('pages.subscriptions.create', compact('companies', 'plans'));
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::id();
        $company = Company::find($data['company_id']);
        if($company->subscription()->exists()){
            $company->subscription()->delete();
        }
        $subscription = Subscription::create($data);
        if (empty($data['ends_at'])) {
            if ($subscription->billing_cycle == 'monthly') {
                $subscription->ends_at = $subscription->starts_at->addMonth();
            } elseif ($subscription->billing_cycle == 'yearly') {
                $subscription->ends_at = $subscription->starts_at->addYear();
            }
        }
        $subscription->save();

        SubscriptionHistory::create([
            'subscription_id' => $subscription->id,
            'company_id' => $subscription->company_id,
            'old_plan_id' => $company->current_plan_id ?? null,
            'new_plan_id' => $data['plan_id'],
            'action' => 'created',
            'changed_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Update company's current subscription
        $company = $subscription->company;
        $company->trial_ends_at = $subscription->ends_at;
        $company->current_plan_id = $data['plan_id'];
        $company->save();
        return redirect()->route('subscriptions.index')->with('success', __('Subscription created successfully.'));
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['company.user', 'plan.features', 'creator']);
        return view('pages.subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        abort(404);
        // $companies = Company::all();
        // $plans = Plan::all();
        // return view('pages.subscriptions.edit', compact('subscription', 'companies', 'plans'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', __('Subscription deleted successfully.'));
    }
    public function activate(Subscription $subscription)
    {
        $subscription->status = 'active';
        $subscription->starts_at = now();
        if ($subscription->billing_cycle == 'monthly') {
            $subscription->ends_at = $subscription->starts_at->addMonth();
        } elseif ($subscription->billing_cycle == 'yearly') {
            $subscription->ends_at = $subscription->starts_at->addYear();
        }
        $subscription->save();
        SubscriptionHistory::create([
            'subscription_id' => $subscription->id,
            'company_id' => $subscription->company_id,
            'old_plan_id' => $subscription->company->current_plan_id,
            'new_plan_id' => $subscription->plan_id,
            'action' => 'renewed',
            'changed_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $company = $subscription->company;
        $company->trial_ends_at = $subscription->ends_at;
        $company->current_plan_id = $subscription->plan_id;
        $company->status = 'active';
        $company->save();
        return redirect()->route('subscriptions.index')->with('success', __('Subscription activated successfully.'));
    }
    public function cancel(Subscription $subscription)
    {
        $subscription->status = 'cancelled';
        $subscription->ends_at = now();
        $subscription->save();
        SubscriptionHistory::create([
            'subscription_id' => $subscription->id,
            'company_id' => $subscription->company_id,
            'old_plan_id' => $subscription->company->current_plan_id,
            'new_plan_id' => null,
            'action' => 'cancelled',
            'changed_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $company = $subscription->company;
        $company->trial_ends_at = $subscription->ends_at;
        $company->status = 'cancelled';
        $company->save();
        return redirect()->route('subscriptions.index')->with('success', __('Subscription cancelled successfully.'));
    }
}
