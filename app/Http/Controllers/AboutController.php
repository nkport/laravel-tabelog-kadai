<?php

namespace App\Http\Controllers;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
        // Aboutページが1つしかない場合
        $about = About::first();
        return view('company.introduction', ['about' => $about]);
    }
}
