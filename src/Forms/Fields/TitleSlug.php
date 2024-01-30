<?php

namespace Hup234design\FilamentCms\Forms\Fields;

use Filament\Forms;
use Illuminate\Support\Str;

class TitleSlug
{
    public static function make($model): Forms\Components\Group
    {
        return Forms\Components\Group::make()
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique($model, 'slug', ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),
            ]);
    }
}
