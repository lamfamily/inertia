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
    Route::get('test1', [\App\Http\Controllers\TestController::class, 'test1'])->name('test1');
    Route::get('test2', [\App\Http\Controllers\TestController::class, 'test2'])->name('test2');
    Route::get('test3', [\App\Http\Controllers\TestController::class, 'test3'])->name('test3');
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
