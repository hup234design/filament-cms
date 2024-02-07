<?php

namespace Hup234design\FilamentCms\Resources\Enquiries;

use Hup234design\FilamentCms\Resources\Enquiries\EnquiryResource\Pages;
use Hup234design\FilamentCms\Resources\Enquiries\EnquiryResource\RelationManagers;
use Hup234design\FilamentCms\Mail\EnquirySubmitted;
use Hup234design\FilamentCms\Models\Enquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class EnquiryResource extends Resource
{
    protected static ?string $model = Enquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?int $navigationSort = 20;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                Forms\Components\TextInput::make('name')
//                    ->required(),
//                Forms\Components\TextInput::make('email')
//                    ->email()
//                    ->required(),
//                Forms\Components\TextInput::make('telephone')
//                    ->tel(),
//                Forms\Components\TextInput::make('subject')
//                    ->required(),
//                Forms\Components\Textarea::make('message')
//                    ->required()
//                    ->columnSpanFull(),
//                Forms\Components\TextInput::make('ip_address')
//                    ->required(),
//                Forms\Components\Toggle::make('spam')
//                    ->required(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('name'),
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('telephone'),
                Infolists\Components\TextEntry::make('referral')->label("How did you hear about us?"),
                Infolists\Components\TextEntry::make('subject'),
                Infolists\Components\TextEntry::make('message')
                    ->columnSpanFull(),
                Infolists\Components\TextEntry::make('created_at')
                    ->label('Received')
                    ->dateTime(),
                Infolists\Components\TextEntry::make('ip_address')
                    ->label('IP Address'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('spam')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('primary')
                    ->slideOver()
                    ->extraModalFooterActions([
                        Tables\Actions\Action::make('resend-email')
                            ->icon('heroicon-m-envelope')
                            ->color('primary')
                            ->requiresConfirmation()
                            ->action(function (Enquiry $record) {
                                Mail::to('dave@hup234design.co.uk')->send(new EnquirySubmitted($record));
                            })
                            ->cancelParentActions()
                            ->hidden(fn(Enquiry $record) => $record->spam),
                        Tables\Actions\Action::make('mark-as-spam')
                            ->icon('heroicon-m-shield-exclamation')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->action(function (Enquiry $record) {
                                $record->update(['spam' => true]);
                            })
                            ->cancelParentActions()
                            ->hidden(fn(Enquiry $record) => $record->spam),
                        Tables\Actions\Action::make('mark-as-not-spam')
                            ->icon('heroicon-m-shield-check')
                            ->color('success')
                            ->requiresConfirmation()
                            ->action(function (Enquiry $record) {
                                $record->update(['spam' => false]);
                            })
                            ->cancelParentActions()
                            ->visible(fn(Enquiry $record) => $record->spam),
                        Tables\Actions\DeleteAction::make()
                            ->cancelParentActions(),
                    ]),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark-as-spam')
                        ->icon('heroicon-s-shield-exclamation')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['spam' => true])),
                    Tables\Actions\BulkAction::make('not-spam')
                        ->icon('heroicon-s-shield-check')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->update(['spam' => false])),
                ])
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEnquiries::route('/'),
            //'view' => Pages\ViewEnquiry::route('/{record}'),
        ];
    }
}
