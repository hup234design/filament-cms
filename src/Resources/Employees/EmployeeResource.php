<?php

namespace Hup234design\FilamentCms\Resources\Employees;

use Awcodes\Curator\Components\Tables\CuratorColumn;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Forms\Fields\MediablePicker;
use Hup234design\FilamentCms\Resources\Employees\EmployeeResource\Pages;
use Hup234design\FilamentCms\Resources\Employees\EmployeeResource\RelationManagers;
use Hup234design\FilamentCms\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('job_title'),
                MediablePicker::make("featured_image","featured")
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('bio')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('email')
                    ->inlineLabel()
                    ->email(),
                Forms\Components\TextInput::make('linkedin')
                    ->inlineLabel()
                    ->url(),
                Forms\Components\TextInput::make('twitter')
                    ->inlineLabel()
                    ->url(),
                Forms\Components\TextInput::make('threads')
                    ->inlineLabel()
                    ->url()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->defaultSort('order_column', 'asc')
            ->columns([
                CuratorColumn::make('featured_image.media')
                    ->label('Image')
                    ->size(80)
                    ->extraCellAttributes(['style' => 'width: 160px;']),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_visible'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmployees::route('/'),
        ];
    }
}
