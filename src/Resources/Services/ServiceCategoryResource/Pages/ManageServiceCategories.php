<?php

namespace Hup234design\FilamentCms\Resources\Services\ServiceCategoryResource\Pages;

use Hup234design\FilamentCms\Resources\Services\ServiceCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageServiceCategories extends ManageRecords
{
    protected static string $resource = ServiceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label('New Category'),
            Actions\Action::make('Services')
                ->icon('heroicon-m-arrow-uturn-left')
                ->outlined(true)
                ->url('/admin/services/services')
        ];
    }
}
