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

Route::get('/', [AdvertiseController::class, 'index'])->name('home');

    
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/dashboard', [AdvertiseController::class, 'MyAdvertyse'])->name('dashboard');
    });
    
    
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    ])->group(function () {
        Route::get('/newAdvertise', [AdvertiseController::class, 'newAdForm'])->name('newAdvertise');
        Route::get('/allPosts', [AdvertiseController::class, 'allPosts'])->name('allPosts');
        Route::post('/newAdvertise', [AdvertiseController::class, 'store'])->name('newAdvertise');
        Route::get('/singleAd/{id}', [AdvertiseController::class, 'showSinglePost'])->name('singleAd');
        Route::get('/advertise/editAd/{id}', [AdvertiseController::class, 'editAd'])->name('edit');
        Route::get('/advertise/search/{term}', [AdvertiseController::class, 'searchByTerm'])->name('search');
        Route::get('/menu', [AdvertiseController::class, 'showMenu'])->name('menu');

        /* Usando Post para atualizar pois o laravel não recebe formdata via PUT */
        Route::post('/advertise/editAd/{advertise}', [AdvertiseController::class, 'saveEditAd'])->name('editad');
        Route::delete('/advertise/delete/{advertise}', [AdvertiseController::class, 'deleteAd'])->name('deleteAd');

    });

