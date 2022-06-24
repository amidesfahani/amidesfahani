<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
	    'prefix' => '{lang?}', 
	    'where' => ['lang' => '[a-zA-Z]{2}'], 
	    'middleware' => 'locale'
    ],
function() {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::get('portfolios', [HomeController::class, 'portfolios'])->name('portfolios');
	Route::get('portfolios/{portfolio}/{slug?}', [HomeController::class, 'portfolio'])->name('portfolios.show');
	Route::get('history', [HomeController::class, 'history'])->name('history');
	Route::get('contact', [HomeController::class, 'contact'])->name('contact');
	Route::get('blog', [HomeController::class, 'blog'])->name('blog');
});