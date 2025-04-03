<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }
    // {
    //     $totalAllUsers = User::count(); // Hitung jumlah pengguna
    //     $totalProducts = Product::count(); // Hitung jumlah produk
    //     $totalOrders = Order::count(); // Hitung jumlah pesanan

    //     dd(compact('totalAllUsers', 'totalProducts', 'totalOrders')); // Debugging

    //     return view('pages.dashboard', compact('totalAllUsers', 'totalProducts', 'totalOrders'));
    // }
}
