<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Profile\RegisterController;
use App\Http\Controllers\Profile\LoginController;

Route::get('/', function () {
    return view('modules.home.index', ['active' => 'home']);
});

Route::get('/network', function () {
    return view('modules.network.index', ['active' => 'network']);
});

Route::get('/events', function () {
    return view('modules.events.index', ['active' => 'events']);
});

Route::get('/jobs', function () {
    return view('modules.jobs.index', ['active' => 'jobs']);
});

Route::get('/news', function () {
    return view('modules.news.index', ['active' => 'news']);
});

Route::get('/profile', function () {
    return view('modules.profile.index', ['active' => 'profile']);
})->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
