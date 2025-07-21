<?php

use App\Livewire\Settings\{Appearance, Password, Profile};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('dashboard/categories', \App\Livewire\Categories\Index::class)->name('dashboard.categories');
    Route::get('dashboard/tags', \App\Livewire\Tags\Index::class)->name('dashboard.tags');
    Route::get('dashboard/articles', \App\Livewire\Articles\Index::class)->name('dashboard.articles');
    Route::get('dashboard/articles/create', \App\Livewire\Articles\CreateArticle::class)->name('dashboard.articles.create');
    Route::get('dashboard/articles/{article}/edit', \App\Livewire\Articles\UpdateArticle::class)->name('dashboard.articles.edit');
    Route::get('home', \App\Livewire\Home\Index::class)->name('home.index');
    Route::get('articles/{slug}', \App\Livewire\Home\Show::class)->name('articles.show');
});

require __DIR__ . '/auth.php';
