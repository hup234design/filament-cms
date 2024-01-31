<?php

namespace Hup234design\FilamentCms\Resources\Employees\EmployeeResource\Pages;

use Hup234design\FilamentCms\Resources\Employees\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEmployees extends ManageRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver(),
        ];
    }
}
