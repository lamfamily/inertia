<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\IndexController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [PageController::class, 'home']);
// Route::get('/about', [PageController::class, 'about'])->name('about');
// Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard');

Route::group(['prefix' => 'test'], function () {
    for ($i = 1; $i <= 100; $i++) {
        Route::get("test{$i}", function () use ($i) {
            return Inertia::render("Test/Test{$i}");
        })->name("test{$i}");
    }
});


Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/about', function () {
    return Inertia::render('About');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});
