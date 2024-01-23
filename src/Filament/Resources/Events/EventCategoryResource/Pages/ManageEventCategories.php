<?php

namespace Hup234design\FilamentCms\Filament\Resources\Events\EventCategoryResource\Pages;

use Hup234design\FilamentCms\Filament\Resources\Events\EventCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEventCategories extends ManageRecords
{
    protected static string $resource = EventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Manage Events')
                ->color('info')
                ->url('/admin/events/events')
        ];
    }
}
