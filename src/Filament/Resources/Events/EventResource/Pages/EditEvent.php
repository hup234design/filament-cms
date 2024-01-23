<?php

namespace Hup234design\FilamentCms\Filament\Resources\Events\EventResource\Pages;

use Hup234design\FilamentCms\Filament\Resources\Events\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
