<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


Route::get('/', function () {
    return view('main.main');
})->name('home')
    ->middleware(['auth', 'verified']);
Route::get('/gallery', function () {
    return view('galeries');
})->name('gallery')
    ->middleware(['auth', 'verified']);
Route::get('/about', function () {
    return view('AboutUs');
})->name('about')
    ->middleware(['auth', 'verified']);
Route::get('/news', function () {
    return view('main.news');
})->name('news')
    ->middleware(['auth', 'verified']);
Route::get('/read/{hash}/{id}', function ($hash, $id) {
    $key = intval($id);
    return view('main.news-content', compact('key'));
})->name('news-content')
    ->middleware(['auth', 'verified']);
Route::get('/announcements', function () {
    return view('main.announcement');
})->name('announcements')
    ->middleware(['auth', 'verified']);
Route::get('/events', function () {
    return view('main.events');
})->name('events')
    ->middleware(['auth', 'verified']);
Route::get('/announcement-comment/{id}', function ($id) {
    Session::put('comment', $id);
    return redirect('/announcements#' . $id)->with('comment', $id);
})->name('comment_section')
    ->middleware(['auth', 'verified']);

Route::view('NewsPage', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




Route::view('announcement', 'announcement')
    ->middleware(['auth', 'verified'])
    ->name('announcement');

Route::view('event', 'events')
    ->middleware(['auth', 'verified'])
    ->name('event');
Route::view('view-news', 'view-news')
    ->middleware(['auth', 'verified'])
    ->name('view-news');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
