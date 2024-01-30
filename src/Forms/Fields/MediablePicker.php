<?php

namespace Hup234design\FilamentCms\Forms\Fields;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Hup234design\FilamentCms\Forms\Components\MediablePreview;

class MediablePicker
{
    public static function make(): Forms\Components\Section
    {
        return Forms\Components\Section::make('Featured Image')
            ->relationship('featured_image')
            ->collapsible()
            ->collapsed()
            ->columns(4)
            ->schema([
//                Forms\Components\Group::make([
                    Forms\Components\Hidden::make('type')
                        ->default('featured'),
                    CuratorPicker::make('media_id')
                        ->label('Image')
                        ->live()
                        ->afterStateUpdated(function (Forms\Set $set, $state) {
                            $set('curation', null);
                        }),
                    Forms\Components\Select::make('curation')
                        ->placeholder('No Curation')
                        ->options(fn(Forms\Get $get) => collect(collect($get('media_id'))->first()['curations'] ?? [])
                            ->mapWithKeys(function ($item) {
                                return [$item["curation"]["key"] => $item["curation"]["key"]];
                            }))
                        ->live()
                        ->visible(fn(Forms\Get $get) => $get('media_id')),
//                ]),
                MediablePreview::make('preview')
                    ->media(fn(Forms\Get $get) => $get('media_id'))
                    ->curation(fn(Forms\Get $get) => $get('curation'))
                    ->columnSpan(2)
                    ->visible(fn(Forms\Get $get) => $get('media_id'))
            ]);
    }
}
