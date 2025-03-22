<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $userCount = User::count();
        dd($productCount, $userCount);
        return view('pages.dashboard', compact('productCount', 'userCount'));
    }
}
