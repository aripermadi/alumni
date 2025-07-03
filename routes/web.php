<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
});

Route::get('/login', function () {
    return view('modules.profile.login');
})->name('login')->middleware('guest');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/profile');
    }
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput();
})->middleware('guest');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');
