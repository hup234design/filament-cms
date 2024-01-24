<?php

use Hup234design\FilamentCms\Http\Controllers\PageController;
use Hup234design\FilamentCms\Http\Controllers\PostController;
use Hup234design\FilamentCms\Http\Controllers\ServiceController;
use Hup234design\FilamentCms\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['web'])->group(function () {

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

    Route::get('/services/category/{slug}', [ServiceController::class, 'category'])->name('services.category');
    Route::get('/services/{slug}', [ServiceController::class, 'service'])->name('services.service');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

    Route::get('/posts/category/{slug}', [PostController::class, 'category'])->name('posts.category');
    Route::get('/posts/{slug}', [PostController::class, 'post'])->name('posts.post');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::get('/{slug}', [PageController::class, 'page'])->name('pages.page');
    Route::get('/', [PageController::class, 'home'])->name('pages.home');

});
