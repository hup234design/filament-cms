<?php

namespace Hup234design\FilamentCms\Forms\Fields;

use Filament\Forms;

class Header
{
    public static function make(): Forms\Components\Section
    {
        return Forms\Components\Section::make('Header')
            ->collapsible()
            ->collapsed()
            ->relationship('header')
            ->schema([
                Forms\Components\TextInput::make('heading'),
                Forms\Components\TextInput::make('subheading'),
                Forms\Components\Textarea::make('text')
                    ->rows(3),
            ]);
    }
}
