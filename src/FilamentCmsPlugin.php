<?php

namespace Hup234design\FilamentCms;

use Awcodes\Curator\CuratorPlugin;
use Filament\Forms\Components\Select;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Contracts\Plugin;
use Hup234design\FilamentCms\Resources\Employees\EmployeeResource;
use Hup234design\FilamentCms\Resources\Pages\IndexPageResource;
use Hup234design\FilamentCms\Resources\Pages\PageResource;
use Hup234design\FilamentCms\Resources\Posts\PostCategoryResource;
use Hup234design\FilamentCms\Resources\Posts\PostResource;
use Hup234design\FilamentCms\Resources\Services\ServiceCategoryResource;
use Hup234design\FilamentCms\Resources\Services\ServiceResource;
use Hup234design\FilamentCms\Resources\Testimonials\TestimonialResource;
use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Page;
use Illuminate\Support\Facades\Schema;
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
                PostCategoryResource::class,
                PostResource::class,
                ServiceCategoryResource::class,
                ServiceResource::class,
                TestimonialResource::class,
                EmployeeResource::class
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
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationCountBadge(),
                FilamentNavigation::make()
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
            ])
            ->viteTheme('resources/css/filament/admin/theme.css');
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
