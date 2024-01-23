<?php

namespace Hup234design\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
//use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Service;
use Hup234design\FilamentCms\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        //$page = IndexPage::where('for', 'services')->firstOrFail();

        $services = Service::with('service_category')->visible()->paginate(3);

        //return view('cms::services.index', compact('page', 'services'));
        return view('cms::services.index', compact('services'));
    }

    public function service($slug)
    {
        $service = Service::whereSlug($slug)->firstOrFail();
        return view('cms::services.service', compact('service'));
    }

    public function category($slug)
    {
        $category = ServiceCategory::whereSlug($slug)->firstOrFail();

        $services = $category->services()->with('service_category')->visible()->paginate(3);

        return view('cms::services.category', compact('category','services'));
    }
}
