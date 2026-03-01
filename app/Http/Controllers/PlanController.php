<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('pages.plans.create');
    }

    public function store(StorePlanRequest $request)
    {
        Plan::create($request->validated());
        return redirect()->route('plans.index')->with('success', __('Plan created successfully.'));
    }

    public function show(Plan $plan)
    {
        return view('pages.plans.show', compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('pages.plans.edit', compact('plan'));
    }

    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $plan->update($request->validated());
        return redirect()->route('plans.index')->with('success', __('Plan updated successfully.'));
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('plans.index')->with('success', __('Plan deleted successfully.'));
    }
}
