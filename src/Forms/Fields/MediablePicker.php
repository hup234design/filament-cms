<?php

namespace Hup234design\FilamentCms\Forms\Fields;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Hup234design\FilamentCms\Forms\Components\MediablePreview;

class MediablePicker
{
    public function __construct(
        public string $relationship,
        public string $type
    ) {}

    public static function make(string $relationship, string $type): Forms\Components\Group
    {
        return Forms\Components\Group::make()
            ->relationship($relationship)
            ->columns(3)
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Hidden::make('type')
                        ->default($type),
                    CuratorPicker::make('media_id')
                        ->label('Image')
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set, Forms\Get $get, $state) use ($type) {
                            $set('curation', $get('curation') ?: $type);
                        }),
                    Forms\Components\Select::make('curation')
                        ->placeholder('No Curation')
                        ->options(fn(Forms\Get $get) => collect(collect($get('media_id'))->first()['curations'] ?? [])
                            ->mapWithKeys(function ($item) {
                                return [$item["curation"]["key"] => $item["curation"]["key"]];
                            }))
                        ->default($type)
                        ->live()
                        ->visible(fn(Forms\Get $get) => $get('media_id')),
                ]),
                MediablePreview::make('preview')
                    ->media(fn(Forms\Get $get) => $get('media_id'))
                    ->curation(fn(Forms\Get $get) => $get('curation'))
                    ->columnSpan(2)
                    ->visible(fn(Forms\Get $get) => $get('media_id'))
            ]);
    }
}
