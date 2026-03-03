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
        $subscription = Subscription::create($data);
        if ($subscription->billing_cycle == 'monthly') {
            $subscription->ends_at = $subscription->starts_at->addMonth();
        } elseif ($subscription->billing_cycle == 'yearly') {
            $subscription->ends_at = $subscription->starts_at->addYear();
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
        return view('pages.subscriptions.show', compact('subscription'));
    }

    public function edit(Subscription $subscription)
    {
        $companies = Company::all();
        $plans = Plan::all();
        return view('pages.subscriptions.edit', compact('subscription', 'companies', 'plans'));
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $data = $request->validated();
        $data['company_id'] = $subscription->company_id;
        $subscription->update($data);
        if($request['billing_cycle'] == 'monthly'){
            $subscription->ends_at = $subscription->starts_at->addMonth();
        }elseif($request['billing_cycle'] == 'yearly'){
            $subscription->ends_at = $subscription->starts_at->addYear();
        }
        $subscription->save();
        if ($request['plan_id'] != $subscription->plan_id) {
            SubscriptionHistory::create([
                'subscription_id' => $subscription->id,
                'company_id' => $subscription->company_id,
                'old_plan_id' => $subscription->company->current_plan_id,
                'new_plan_id' => $request['plan_id'],
                'action' => 'updated',
                'changed_by' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $company = $subscription->company;
            $company->current_plan_id = $request['plan_id'];
            $company->save();
        }
        return redirect()->route('subscriptions.index')->with('success', __('Subscription updated successfully.'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', __('Subscription deleted successfully.'));
    }
}
