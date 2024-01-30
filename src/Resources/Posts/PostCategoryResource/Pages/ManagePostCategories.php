<?php

namespace Hup234design\FilamentCms\Resources\Posts\PostCategoryResource\Pages;

use Hup234design\FilamentCms\Resources\Posts\PostCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePostCategories extends ManageRecords
{
    protected static string $resource = PostCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Manage Posts')
                ->color('info')
                ->url('/admin/posts/posts')
        ];
    }
}
