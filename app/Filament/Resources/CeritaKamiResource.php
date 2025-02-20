<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CeritaKamiResource\Pages;
use App\Filament\Resources\CeritaKamiResource\RelationManagers;
use App\Models\CeritaKami;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CeritaKamiResource extends Resource
{
    protected static ?string $model = CeritaKami::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->label('Judul')
                    ->required(),
                Forms\Components\Datepicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),
                Forms\Components\Textarea::make('cerita')
                    ->label('Cerita')
                    ->required(),
                Forms\Components\FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->directory('cerita_kami')
                    ->visibility('public')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->sortable(),
                Tables\Columns\TextColumn::make('cerita')->sortable(),
                Tables\Columns\TextColumn::make('foto'),
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
            'index' => Pages\ListCeritaKamis::route('/'),
            'create' => Pages\CreateCeritaKami::route('/create'),
            'edit' => Pages\EditCeritaKami::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return 'Cerita Kami';
    }
}
