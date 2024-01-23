<?php

namespace Hup234design\FilamentCms;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentCmsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'cms';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasMigrations([
                'create_pages_table',
                'create_post_categories_table',
                'create_posts_table',
                'create_event_categories_table',
                'create_events_table',
                'create_service_categories_table',
                'create_services_table',
                'create_testimonials_table',
            ])
            ->hasViews('cms')
            ->hasRoute('web');
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();
    }

    public function packageBooted(): void
    {
        //
    }
}

