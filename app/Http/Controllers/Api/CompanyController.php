<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Traits\ApiResponse;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ApiResponse;
    public function index()
    {
        $companies = Company::where('status' , '!=','cancelled')->get();
        return $this->successResponse(CompanyResource::collection($companies) , 'Companies retrieved successfully');
    }
    public function show(string $name , string $uid)
    {
        $company = Company::where('name' , $name)->where('uid' , $uid)->first();
        return $this->successResponse(new CompanyResource($company) , 'Company retrieved successfully');
    }

}
