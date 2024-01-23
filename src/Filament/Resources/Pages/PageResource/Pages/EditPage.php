<?php

namespace Hup234design\FilamentCms\Filament\Resources\Pages\PageResource\Pages;

use Hup234design\FilamentCms\Filament\Resources\Pages\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
