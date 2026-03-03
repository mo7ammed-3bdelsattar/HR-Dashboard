<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('pages.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('pages.companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $validatedData = $request->validated();

        // Create the admin user
        $user = \App\Models\User::create([
            'name' => $validatedData['admin_name'],
            'email' => $validatedData['admin_email'],
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'company_admin',
        ]);

        $companyData = $validatedData;
        unset($companyData['admin_name'], $companyData['admin_email']);
        $companyData['user_id'] = $user->id;
        $companyData['uid'] = \Illuminate\Support\Str::uuid()->toString();

        if ($request->hasFile('logo')) {
            $companyData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($companyData);

        return redirect()->route('companies.index')->with('success', __('Company created successfully.'));
    }

    public function show(Company $company)
    {
        $plans = \App\Models\Plan::all();
        return view('pages.companies.show', compact('company', 'plans'));
    }

    public function edit(Company $company)
    {
        return view('pages.companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->validated();
        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $company->update($data);
        return redirect()->route('companies.index')->with('success', __('Company updated successfully.'));
    }

    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success', __('Company deleted successfully.'));
    }
}
