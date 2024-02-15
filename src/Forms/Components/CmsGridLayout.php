<?php

namespace Hup234design\FilamentCms\Forms\Components;

use Closure;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use RalphJSmit\Filament\Components\Forms\Timestamps;

class CmsGridLayout
{
    public function __construct(
        public array|Closure $mainComponents,
        public array|Closure $asideComponents
    ) {}

    public static function make(array|Closure $mainComponents, array|Closure $asideComponents): Grid
    {
        return Grid::make([
            'default' => 1,
            'lg' => 3,
            'xl' => 6,
            '2xl' => 8
        ])->schema([
            Group::make()
                ->columnSpan([
                    'lg' => 2,
                    'xl' => 4,
                    '2xl' => 6,
                ])
                ->schema($mainComponents),
            Group::make()
                ->columnSpan([
                    'lg' => 1,
                    'xl' => 2,
                ])
                ->schema([
                    ...$asideComponents,
                    Section::make(Timestamps::make())
                ]),
        ]);
    }
}
