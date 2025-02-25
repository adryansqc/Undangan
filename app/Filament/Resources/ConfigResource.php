<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfigResource\Pages;
use App\Filament\Resources\ConfigResource\RelationManagers;
use App\Models\Config;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConfigResource extends Resource
{
    protected static ?string $model = Config::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('key')
                    ->label('Key')
                    ->required(),

                Select::make('type')
                    ->label('Type')
                    ->options([
                        'text' => 'Text',
                        'file' => 'File',
                        'date' => 'Date',
                        'color' => 'Color',
                    ])
                    ->required()
                    ->reactive(),

                TextInput::make('value')
                    ->label('Value')
                    ->required()
                    ->hidden(fn($get) => in_array($get('type'), ['file', 'date', 'color'])),

                FileUpload::make('value')
                    ->label('Upload File')
                    // ->required()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'application/pdf'])
                    ->hidden(fn($get) => $get('type') !== 'file')
                    ->disk('public')
                    ->directory('undangan')
                    ->visibility('public')
                    ->preserveFilenames() // Biarkan nama file tetap sama
                    ->getUploadedFileNameForStorageUsing(fn($file) => $file->hashName()) // Simpan file dengan nama unik
                    ->dehydrateStateUsing(fn($state) => is_array($state) ? implode(',', $state) : $state) // Ubah array ke string
                    ->formatStateUsing(fn($state) => is_array($state) ? $state[0] ?? null : $state) // Pastikan hanya path file yang tersimpan
                    ->afterStateHydrated(fn($state, callable $set) => is_array($state) ? $set('value', $state[0] ?? null) : null),


                DatePicker::make('value')
                    ->label('Select Date')
                    ->required()
                    ->hidden(fn($get) => $get('type') !== 'date'),

                ColorPicker::make('value')
                    ->label('Pilih Warna')
                    ->hidden(fn($get) => $get('type') !== 'color')
                // ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListConfigs::route('/'),
            'create' => Pages\CreateConfig::route('/create'),
            'edit' => Pages\EditConfig::route('/{record}/edit'),
        ];
    }
}
