<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Profile\RegisterController;
use App\Http\Controllers\Profile\LoginController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\News;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\JobsController;

Route::get('/', function () {
    $upcomingEvents = Event::whereDate('event_date', '>=', now())
        ->orderByDesc('event_date')
        ->limit(3)
        ->get();
    $latestNews = News::orderByDesc('published_at')
        ->limit(3)
        ->get();
    return view('modules.home.index', [
        'active' => 'home',
        'upcomingEvents' => $upcomingEvents,
        'latestNews' => $latestNews,
    ]);
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

Route::get('/events/all', [EventController::class, 'all'])->name('events.all');
Route::get('/news/all', [NewsController::class, 'all'])->name('news.all');

Route::resource('news', NewsController::class)->middleware('auth');
Route::resource('events', EventController::class)->middleware('auth');

Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show')->middleware('auth');
Route::get('events/{event}', [EventController::class, 'show'])->name('events.show')->middleware('auth');

Route::get('/events/public/{id}', [EventController::class, 'publicShow'])->name('events.public.show');
Route::get('/news/public/{id}', [NewsController::class, 'publicShow'])->name('news.public.show');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');

Route::resource('user', UserController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'passwordUpdate'])->name('profile.password.update');
    Route::post('/profile/update-picture', [App\Http\Controllers\ProfileController::class, 'updatePicture'])->name('profile.update-picture');
});

Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');

Route::middleware('auth')->group(function () {
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::post('/forum/{id}/reply', [ForumController::class, 'reply'])->name('forum.reply');
});

Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');

Route::get('/jobs/all', [JobsController::class, 'all'])->name('jobs.all');

Route::resource('jobs', JobsController::class)->middleware(['auth']);

Route::get('/jobs/public/{id}', [JobsController::class, 'publicShow'])->name('jobs.public.show');
