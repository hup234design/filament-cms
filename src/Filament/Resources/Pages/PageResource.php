<?php

namespace Hup234design\FilamentCms\Filament\Resources\Pages;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Filament\Resources\Pages\PageResource\Pages;
use Hup234design\FilamentCms\Filament\Resources\Pages\PageResource\RelationManagers;
use Hup234design\FilamentCms\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('is_home','desc')
            ->orderBy('is_visible','asc');
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(Page::class, 'slug', ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                ])
                ->columnSpanFull()
                ->columns(2),
            TiptapEditor::make('content')
                ->profile('minimal')
                ->output(TiptapOutput::Json)
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_home')
                ->label('Home Page')
                ->default(false)
                ->live()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_visible')
                ->label('Visible')
                ->default(true)
                ->columnSpanFull()
                ->hidden(fn(Forms\Get $get) => $get('is_home')),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_home')
                    ->label(false)
                    ->trueIcon('heroicon-s-home')
                    ->falseIcon(false)
                    ->extraCellAttributes(['style' => 'width: 40px']),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible?')
                    ->disabled(fn(Page $record) => $record->is_home),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
