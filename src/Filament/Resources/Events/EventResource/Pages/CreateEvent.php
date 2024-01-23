<?php

namespace Hup234design\FilamentCms\Filament\Resources\Events\EventResource\Pages;

use Hup234design\FilamentCms\Filament\Resources\Events\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
