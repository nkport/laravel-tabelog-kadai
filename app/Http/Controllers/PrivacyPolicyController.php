<?php

namespace App\Http\Controllers;
use App\Models\PrivacyPolicy;
use App\Models\Company;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function show()
    {
        // プライバシーポリシーが1つしかない場合
        $policy = PrivacyPolicy::first();
        $company = Company::all();
        return view('company.policy', compact('policy', 'company'));
    }
}
