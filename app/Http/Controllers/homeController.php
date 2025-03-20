<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function home()
    {
        return view('home.home');
    }

    public function about()
    {
        return view('home.about');
    }

    public function explore()
    {
        return view('home.explore');
    }

    public function trending()
    {
        return view('home.trending');
    }

    public function contact()
    {
        return view('home.contact');
    }
}
