<?php

namespace Hup234design\FilamentCms\Forms\Fields;


use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Hup234design\FilamentCms\ContentBlocks\ButtonsBlock;
use Hup234design\FilamentCms\ContentBlocks\CallToActionBlock;
use Hup234design\FilamentCms\ContentBlocks\CardsBlock;
use Hup234design\FilamentCms\ContentBlocks\ContactBlock;
use Hup234design\FilamentCms\ContentBlocks\ImagesBlock;
use Hup234design\FilamentCms\ContentBlocks\LatestEventsBlock;
use Hup234design\FilamentCms\ContentBlocks\LatestPostsBlock;
use Hup234design\FilamentCms\ContentBlocks\MediaObjectBlock;
use Hup234design\FilamentCms\ContentBlocks\MediaObjectListBlock;

class ContentBlockHeader
{
    public static function make(): Group
    {
        return Group::make()
            ->schema([
                Select::make('header')
                    ->label('Include Header')
                    ->inlineLabel()
                    ->live()
                    ->options([
                        'center' => 'Yes - Center Aligned',
                        'left' => 'Yes - Left Aligned',
                    ])
                    ->placeholder('No'),
                TextInput::make('header_title')
                    ->label('Header Title')
                    ->inlineLabel()
                    ->required()
                    ->visible(fn(Get $get) => $get('header')),
                Textarea::make('header_text')
                    ->label('Header Text')
                    ->inlineLabel()
                    ->visible(fn(Get $get) => $get('header'))
            ])
            ->columnSpanFull();
    }
}
