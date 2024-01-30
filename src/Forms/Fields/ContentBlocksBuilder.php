<?php

namespace Hup234design\FilamentCms\Forms\Fields;

use Filament\Forms\Components\Builder;
use Hup234design\FilamentCms\Livewire\Blocks\EditorBlock;

class ContentBlocksBuilder
{
    public static function make(): Builder
    {
        return Builder::make('blocks')
            ->addActionLabel('Add Content Block')
            ->labelBetweenItems('Insert Content Block')
            ->label(false)
            ->collapsible()
            ->collapsed()
            ->blockNumbers(false)
            ->blocks([
                EditorBlock::make(),
                ...config('cms.content_blocks', [])
            ]);
    }
}
