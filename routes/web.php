<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('home.home');
});
Route::get('/about', function () {
    return view('home.about');
});
Route::get('/explore', function () {
    return view('home.explore');
});
Route::get('/trending', function () {
    return view('home.trending');
});
Route::get('/contact', function () {
    return view('home.contact');
});



// route::get('/', [TemplateController::class, 'index']);

Route::get('/login', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard');
    })->name('home');

    Route::resource('user', UserController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::resource('profile', ProfileController::class);
});
