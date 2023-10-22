<?php

use App\Http\Controllers\AdvertiseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/menu', function () {
        return Inertia::render('Menu');
    })->name('menu');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');

    Route::get('/dashboard', [AdvertiseController::class, 'MyAdvertyse'])->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/newAdvertise', function () {
        return Inertia::render('NewAdvertise');
    })->name('newAdvertise');

    Route::post('/newAdvertise', [AdvertiseController::class, 'store'])->name('newAdvertise');
    Route::get('/singleAd/{id}', [AdvertiseController::class, 'showSinglePost'])->name('singleAd');
    Route::get('/advertise/editAd/{id}', [AdvertiseController::class, 'editAd'])->name('edit');
    
    /* Usando Post para atualizar pois o laravel não recebe formdata via PUT */
    Route::post('/advertise/editAd/{id}', [AdvertiseController::class, 'saveEditAd'])->name('editad');

});
