<?php

namespace Hup234design\FilamentCms;

use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Contracts\Plugin;
use Hup234design\FilamentCms\Filament\Resources\Events\EventCategoryResource;
use Hup234design\FilamentCms\Filament\Resources\Events\EventResource;
use Hup234design\FilamentCms\Filament\Resources\Pages\PageResource;
use Hup234design\FilamentCms\Filament\Resources\Posts\PostCategoryResource;
use Hup234design\FilamentCms\Filament\Resources\Posts\PostResource;
use Hup234design\FilamentCms\Filament\Resources\Services\ServiceCategoryResource;
use Hup234design\FilamentCms\Filament\Resources\Services\ServiceResource;
use Hup234design\FilamentCms\Filament\Resources\Testimonials\TestimonialResource;

class FilamentCmsPlugin implements Plugin
{

    public function getId(): string
    {
        return 'filament-cms';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                PageResource::class,
                PostCategoryResource::class,
                PostResource::class,
                EventCategoryResource::class,
                EventResource::class,
                ServiceCategoryResource::class,
                ServiceResource::class,
                TestimonialResource::class
            ])
            ->pages([
                //
            ])
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->userMenuItems([
                MenuItem::make()
                    ->label('View Site')
                    ->url('/')
                    ->openUrlInNewTab(true)
                    ->icon('heroicon-o-home'),
            ])
            ->breadcrumbs(false)
            ->plugins([
//                CustomFilamentNavigation::make()
//                    ->itemType('Home Page', [])
//                    ->itemType('Index Page', [
//                        Select::make('index_page_id')
//                            ->options(Schema::hasTable('index_pages')
//                                ? IndexPage::all()->pluck('title','id')
//                                : []
//                            )
//                            ->required()
//                    ])
//                    ->itemType('Page', [
//                        Select::make('page_id')
//                            ->options(Schema::hasTable('index_pages')
//                                ? Page::where('is_home',false)->pluck('title','id')
//                                : []
//                            )
//                            ->required()
//                    ])
//                    ->itemType('Dropdown', [])
            ]);
    }

    public function boot(Panel $panel): void
    {
        //NavigationResource::navigationSort(98);
    }

    public static function get(): Plugin | \Filament\FilamentManager
    {
        return filament(app(static::class)->getId());
    }

}
