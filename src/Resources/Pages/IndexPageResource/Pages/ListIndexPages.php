<?php

namespace Hup234design\FilamentCms\Resources\Pages\IndexPageResource\Pages;

use Hup234design\FilamentCms\Resources\Pages\IndexPageResource;
use Filament\Resources\Pages\ListRecords;

class ListIndexPages extends ListRecords
{
    protected static string $resource = IndexPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
