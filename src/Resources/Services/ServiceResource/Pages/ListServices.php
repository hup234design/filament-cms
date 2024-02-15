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
            Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label('New Service'),
            Actions\Action::make('Categories')
                ->icon('heroicon-m-list-bullet')
                ->outlined(true)
                ->url('/admin/services/service-categories')
        ];
    }
}
