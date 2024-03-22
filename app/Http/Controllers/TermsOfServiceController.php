<?php

namespace App\Http\Controllers;
use App\Models\TermsOfService;
use Illuminate\Http\Request;

class TermsOfServiceController extends Controller
{
    public function show()
    {
        // 利用規約が1つしかない場合
        $terms = TermsOfService::first();
        return view('company.terms', ['terms' => $terms]);
    }
}
