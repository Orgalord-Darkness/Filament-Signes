<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\CustomDashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/language-switch', function () {
    $locale = request('locale');
    if (array_key_exists($locale, config('filament.locales'))) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('language.switch');

Route::get('/dashboard ', Dashboard::class)->name('filament.pages.admin');