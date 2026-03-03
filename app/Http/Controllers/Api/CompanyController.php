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
    public function show(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'token' => 'required|string'
        ]);
        $company = Company::where('name' , $request->name)->where('uid' , $request->token)->first();
        if($company){
            return $this->successResponse(new CompanyResource($company) , 'Company retrieved successfully');
        }
        return $this->errorResponse('Company not found' , 404);
    }

}
