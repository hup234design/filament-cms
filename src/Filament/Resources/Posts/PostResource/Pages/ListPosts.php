<?php

namespace Hup234design\FilamentCms\Filament\Resources\Posts\PostResource\Pages;

use Hup234design\FilamentCms\Filament\Resources\Posts\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Manage Categories')
                ->color('info')
                ->url('/admin/posts/post-categories')
        ];
    }
}