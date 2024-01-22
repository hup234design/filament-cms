<?php

namespace Hup234design\FilamentCms;

use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Contracts\Plugin;
use Hup234design\FilamentCms\Filament\Navigation\CustomFilamentNavigation;
use Hup234design\FilamentCms\Filament\Pages\ManageSettings;
use Hup234design\FilamentCms\Filament\Resources\EnquiryResource;
use Hup234design\FilamentCms\Filament\Resources\EventCategoryResource;
use Hup234design\FilamentCms\Filament\Resources\EventResource;
use Hup234design\FilamentCms\Filament\Resources\IndexPageResource;
use Hup234design\FilamentCms\Filament\Resources\PageResource;
use Hup234design\FilamentCms\Filament\Resources\PostCategoryResource;
use Hup234design\FilamentCms\Filament\Resources\PostResource;
use Hup234design\FilamentCms\Filament\Resources\TestimonialResource;
use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Page;
use Illuminate\Support\Facades\Schema;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use RyanChandler\FilamentNavigation\FilamentNavigation;

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
                IndexPageResource::class,
                PostResource::class,
                PostCategoryResource::class,
                EventResource::class,
                EventCategoryResource::class,
                EnquiryResource::class,
                TestimonialResource::class
            ])
            ->pages([
                ManageSettings::class,
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
                CustomFilamentNavigation::make()
                    ->itemType('Home Page', [])
                    ->itemType('Index Page', [
                        Select::make('index_page_id')
                            ->options(Schema::hasTable('index_pages')
                                ? IndexPage::all()->pluck('title','id')
                                : []
                            )
                            ->required()
                    ])
                    ->itemType('Page', [
                        Select::make('page_id')
                            ->options(Schema::hasTable('index_pages')
                                ? Page::where('is_home',false)->pluck('title','id')
                                : []
                            )
                            ->required()
                    ])
                    ->itemType('Dropdown', [])
            ]);
    }

    public function boot(Panel $panel): void
    {
        NavigationResource::navigationSort(98);
    }

    public static function get(): Plugin | \Filament\FilamentManager
    {
        return filament(app(static::class)->getId());
    }

}
