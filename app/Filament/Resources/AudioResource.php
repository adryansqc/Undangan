<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AudioResource\Pages;
use App\Filament\Resources\AudioResource\RelationManagers;
use App\Models\Audio;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AudioResource extends Resource
{
    protected static ?string $model = Audio::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                FileUpload::make('file_path')
                    ->label('Upload Audio')
                    ->disk('public')
                    ->directory('audios')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3'])
                    ->required(),

                Toggle::make('is_active')
                    ->label('Gunakan sebagai Musik?')
                    ->onColor('success'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable(),
                IconColumn::make('is_active')
                    ->label('Aktif?')
                    ->boolean(),
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Set Sebagai Aktif')
                    ->action(fn(Audio $record) => self::setActive($record))
                    ->visible(fn(Audio $record) => !$record->is_active)
                    ->icon('heroicon-o-check'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function setActive(Audio $audio)
    {
        Audio::query()->update(['is_active' => false]);

        $audio->update(['is_active' => true]);
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
            'index' => Pages\ListAudio::route('/'),
            'create' => Pages\CreateAudio::route('/create'),
            'edit' => Pages\EditAudio::route('/{record}/edit'),
        ];
    }
}
