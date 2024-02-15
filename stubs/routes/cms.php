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

//Route::middleware(['web'])->group(function () {

Route::controller(TestimonialController::class)
    ->prefix(cms('testimonials_slug', 'testimonials'))
    ->group(function () {
        Route::get('/', 'index')->name('testimonials.index');
    });

Route::controller(ServiceController::class)
    ->prefix(cms('services_slug', 'services'))
    ->group(function () {
        Route::get('/category/{slug}', 'category')->name('services.category');
        Route::get('/{slug}', 'service')->name('services.service');
        Route::get('/', 'index')->name('services.index');
    });

Route::controller(PostController::class)
    ->prefix(cms('posts_slug', 'posts'))
    ->group(function () {
        Route::get('/category/{slug}', 'category')->name('posts.category');
        Route::get('/{slug}', 'post')->name('posts.post');
        Route::get('/', 'index')->name('posts.index');
    });

Route::controller(PageController::class)
    ->group(function () {
        Route::get('/{slug}', 'page')->name('pages.page');
        Route::get('/', 'home')->name('pages.home');
    });
