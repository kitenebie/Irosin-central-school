<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('main.main');
})->name('home');
Route::get('/news', function () {
    return view('main.news');
})->name('news');
Route::get('/read/{id}', function () {
    return view('main.news-content');
})->name('news-content');
Route::get('/announcements', function () {
    return view('main.announcement');
})->name('announcements');
Route::get('/events', function () {
    return view('main.events');
})->name('events');
Route::get('/announcement-comment/{id}', function () {
    return view('main.announcement-comment');
})->name('announcement-comment/{id}');
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

require __DIR__.'/auth.php';
