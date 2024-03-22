<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $favorite_shops = $user->favorite_shops()->paginate(5);
        $shops = Shops::all();
        return view('profile.favorite', compact('favorite_shops', 'shops'));
    }

    public function store($shop_id)
    {
        Auth::user()->favorite_shops()->attach($shop_id);

        return back();
    }

    public function destroy($shop_id)
    {
        Auth::user()->favorite_shops()->detach($shop_id);

        return back();
    }

}