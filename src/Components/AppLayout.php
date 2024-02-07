<?php

namespace Hup234design\FilamentCms\Components;

use Awcodes\Curator\Models\Media;
use Closure;
use Hup234design\FilamentCms\Services\NavigationItems;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function __construct(){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menus = [
            'primary_header' => NavigationItems::make(cms('primary_header_menu_id', null)),
            'primary_footer' => NavigationItems::make(cms('primary_footer_menu_id', null)),
        ];
        return view('cms::layouts.app', compact('menus'));
    }
}
