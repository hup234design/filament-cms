<?php

namespace Hup234design\FilamentCms\Resources\Pages\PageResource\Pages;

use Hup234design\FilamentCms\Resources\Pages\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
