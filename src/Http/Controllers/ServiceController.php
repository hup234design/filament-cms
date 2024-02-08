<?php

namespace Hup234design\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
//use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Service;
use Hup234design\FilamentCms\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $page = IndexPage::where('slug', 'services')->firstOrFail();
        $services = Service::with('service_category')->visible()->paginate(3);
        return view('services.index', compact('page', 'services'));
    }

    public function service($slug)
    {
        $service = Service::whereSlug($slug)->firstOrFail();
        return view('services.service', compact('service'));
    }

    public function category($slug)
    {
        $category = ServiceCategory::whereSlug($slug)->firstOrFail();
        $services = $category->services()->with('service_category')->visible()->paginate(3);
        return view('services.category', compact('category','services'));
    }
}
