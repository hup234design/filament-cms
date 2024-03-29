<?php

namespace Hup234design\FilamentCms;

use Hup234design\FilamentCms\Commands\RegenerateMediaCurations;
use Hup234design\FilamentCms\Components\MediaImageRenderer;
use Hup234design\FilamentCms\Livewire\Blocks\ContactBlock;
use Hup234design\FilamentCms\Livewire\Blocks\EditorBlock;
use Hup234design\FilamentCms\Livewire\Blocks\EmployeesBlock;
use Hup234design\FilamentCms\Livewire\Blocks\LatestPostsBlock;
use Hup234design\FilamentCms\Livewire\Blocks\TestimonialsBlock;
use Hup234design\FilamentCms\Livewire\Enquiries\EnquiryForm;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentCmsServiceProvider extends PackageServiceProvider
{
    public static string $name = 'cms';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasMigrations([
                'create_navigations_table',
                'create_mediables_table',
                'create_headerables_table',
                'create_pages_table',
                'create_index_pages_table',
                'create_post_categories_table',
                'create_posts_table',
                'create_service_categories_table',
                'create_services_table',
                'create_testimonials_table',
                'create_employees_table',
                'create_enquiries_table',
            ])
            ->hasViews('cms')
            ->hasConfigFile(['cms','curator','filament-tiptap-editor','filament-tree'])
            ->hasCommands([
                Commands\SetupCommand::class,
                RegenerateMediaCurations::class,
            ])
            ->hasViewComponents('cms', MediaImageRenderer::class)
            ->hasViews()
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations();
            });
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        $this->app->singleton(FilamentCmsSettings::class, function () {
            return FilamentCmsSettings::make(storage_path('app/cms-settings.json'));
        });
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        Livewire::component('enquiry-form', EnquiryForm::class);

        Livewire::component('editor-block', EditorBlock::class);
        Livewire::component('employees-block', EmployeesBlock::class);
        Livewire::component('contact-block', ContactBlock::class);
        Livewire::component('latest-posts-block', LatestPostsBlock::class);
        Livewire::component('testimonials-block', TestimonialsBlock::class);

        //Blade::component('curator-glider', Glider::class);
    }
}

