<?php

namespace Hup234design\FilamentCms\Resources\Pages\IndexPageResource\Pages;

use Hup234design\FilamentCms\Resources\Pages\IndexPageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndexPage extends EditRecord
{
    protected static string $resource = IndexPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
