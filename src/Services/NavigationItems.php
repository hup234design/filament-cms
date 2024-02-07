<?php

namespace Hup234design\FilamentCms\Services;

use Hup234design\FilamentCms\Models\Navigation;

class NavigationItems
{
    public static function make($parent_id = null)
    {
        if (!$parent_id) return null;

        $navigation = Navigation::with(['children','page','index_page'])->where('parent_id', $parent_id)->orderBy('order', 'asc')->get();

        if (count($navigation)==0) return null;

        $tree = $navigation->map(function ($navigationItem) {

            $route = null;
            $slug = null;

            if ($navigationItem->page) {
                $route = $navigationItem->page->is_home ? 'pages.home' : 'pages.page';
                $slug = $navigationItem->page->is_home ? null : $navigationItem->page->slug;
            } elseif ($navigationItem->index_page) {
                $route = $navigationItem->index_page->slug . '.index';
            }

            return [
                'title'    => $navigationItem->title,
                'route'    => $route,
                'slug'     => $slug,
                'children' => count($navigationItem->children) ? static::make($navigationItem->id) : null
            ];
        });

        return $tree;
    }
}
