<?php

namespace Hup234design\FilamentCms\Http\Controllers;

use App\Http\Controllers\Controller;
//use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Event;
use Hup234design\FilamentCms\Models\EventCategory;

class EventController extends Controller
{
    public function index()
    {
        //$page = IndexPage::where('for', 'events')->firstOrFail();

        $events = Event::with('event_category')->upcoming()->visible()->paginate(3);

        //return view('cms::events.index', compact('page', 'events'));
        return view('cms::events.index', compact('events'));
    }

    public function event($slug)
    {
        $event = Event::whereSlug($slug)->firstOrFail();
        return view('cms::events.event', compact('event'));
    }

    public function category($slug)
    {
        $category = EventCategory::whereSlug($slug)->firstOrFail();

        $events = $category->events()->with('event_category')->upcoming()->visible()->paginate(3);

        return view('cms::events.category', compact('category','events'));
    }
}
