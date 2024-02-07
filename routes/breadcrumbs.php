<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('pages.home'));
});

// Home > Posts
Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Posts', route('posts.index'));
});

// Home > Services
Breadcrumbs::for('services', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Services', route('services.index'));
});

// Home > Testimonials
Breadcrumbs::for('testimonials', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Testimonials', route('testimonials.index'));
});

