<?php

namespace Hup234design\FilamentCms\Filament\Resources\Testimonials\TestimonialResource\Pages;

use Hup234design\FilamentCms\Filament\Resources\Testimonials\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver(),
        ];
    }
}
