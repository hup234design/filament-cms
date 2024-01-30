<?php

namespace Hup234design\FilamentCms\Resources\Services\ServiceResource\Pages;

use Hup234design\FilamentCms\Resources\Services\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Manage Categories')
                ->color('info')
                ->url('/admin/services/service-categories')
        ];
    }
}
