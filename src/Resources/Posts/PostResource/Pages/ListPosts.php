<?php

namespace Hup234design\FilamentCms\Resources\Posts\PostResource\Pages;

use Hup234design\FilamentCms\Resources\Posts\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label('New Post'),
            Actions\Action::make('Categories')
                ->icon('heroicon-m-list-bullet')
                ->outlined(true)
                ->url('/admin/posts/post-categories')
        ];
    }
}
