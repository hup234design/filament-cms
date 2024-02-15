<?php

namespace Hup234design\FilamentCms\Forms\Fields;

use Filament\Forms;

class Header
{
    public static function make(): Forms\Components\Group
    {
        return Forms\Components\Group::make()
            ->schema([
                Forms\Components\Group::make()
                    ->relationship('header')
                    ->schema([
                        Forms\Components\TextInput::make('heading'),
                        Forms\Components\TextInput::make('subheading'),
                        Forms\Components\Textarea::make('text')
                            ->rows(3),
                    ]),
                MediablePicker::make("header_image", "header")->columnSpanFull(),
            ]);
    }
}
