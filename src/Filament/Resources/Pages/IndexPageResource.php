<?php

namespace Hup234design\FilamentCms\Filament\Resources\Pages;

use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Filament\Resources\Pages\IndexPageResource\Pages;
use Hup234design\FilamentCms\Filament\Resources\Pages\IndexPageResource\RelationManagers;
use Hup234design\FilamentCms\Models\IndexPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IndexPageResource extends Resource
{
    protected static ?string $model = IndexPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\TextInput::make('slug')
                        ->label('For')
                        ->disabled(),
                ])
                ->columnSpanFull()
                ->columns(2),
            TiptapEditor::make('content')
                ->profile('minimal')
                ->output(TiptapOutput::Json)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')
                    ->label('For')
                    ->badge()
                    ->extraCellAttributes(['style' => 'width: 60px']),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

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
                //
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
            'index' => Pages\ListIndexPages::route('/'),
            'edit' => Pages\EditIndexPage::route('/{record}/edit'),
        ];
    }
}