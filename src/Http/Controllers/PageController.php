<?php

namespace Hup234design\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\FilamentCms\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('is_home', true)->first();
        if( $page ) {
            return view('cms::pages.home', compact('page'));
        }
        return view('welcome');

    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->firstOrFail();
        return view('cms::pages.page', compact('page'));
    }
}
