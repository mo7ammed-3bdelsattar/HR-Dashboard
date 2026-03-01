<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Company;
use App\Models\Plan;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
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

        Subscription::create($data);
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
        $subscription->update($request->validated());
        return redirect()->route('subscriptions.index')->with('success', __('Subscription updated successfully.'));
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', __('Subscription deleted successfully.'));
    }
}
