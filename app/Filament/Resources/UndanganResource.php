<?php

namespace App\Filament\Resources;

use App\Filament\Exports\UndanganExporter;
use App\Filament\Imports\UndanganImporter;
use App\Filament\Resources\UndanganResource\Pages;
use App\Filament\Resources\UndanganResource\RelationManagers;
use App\Models\Undangan;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class UndanganResource extends Resource
{
    protected static ?string $model = Undangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama')
                    ->required(),

                Select::make('pronoun')
                    ->label('Sapaan')
                    ->options([
                        'Bapak' => 'Bapak',
                        'Ibu' => 'Ibu',
                        'Saudara' => 'Saudara',
                        'Saudari' => 'Saudari',
                    ])
                    ->default('Bapak/Ibu/Saudara/i')
                    ->required(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->label('Nama')->searchable(),
                TextColumn::make('pronoun')->label('Sapaan'),
                TextColumn::make('slug')->label('Slug')
                    ->formatStateUsing(fn($state) => url('/undangan/' . $state))
                    ->copyable(fn($state) => url('/undangan/' . $state))
                    ->openUrlInNewTab(),
            ])

            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(UndanganExporter::class),
                ImportAction::make()
                    ->importer(UndanganImporter::class)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Copy Link')
                    ->label('Copy')
                    ->icon('heroicon-o-clipboard')
                    ->modalHeading('Salin Link Undangan')
                    ->modalDescription('Tekan dan tahan untuk menyalin link berikut:')
                    ->modalContent(fn($record) => new HtmlString('<input type="text" value="' . url('/undangan/' . $record->slug) . '" readonly class="w-full p-2 border rounded">'))
                    ->modalSubmitActionLabel('Tutup'),
                Action::make('Bagikan')
                    ->label('Bagikan')
                    ->icon('heroicon-o-link')
                    ->url(fn($record) => 'https://wa.me/?text=' . urlencode($record->getUndanganMessage(config('undangan'))))
                    ->openUrlInNewTab(),
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('Bagikan')
                        ->label('Bagikan via WhatsApp')
                        ->icon('heroicon-o-share')
                        ->action(function ($records) {
                            $links = $records->map(fn($record) => url('/undangan/' . $record->slug))->implode("\n");
                            $whatsappUrl = 'https://wa.me/?text=' . urlencode("Undangan untuk Anda:\n" . $links);
                            return redirect()->away($whatsappUrl);
                        }),
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
            'index' => Pages\ListUndangans::route('/'),
            'create' => Pages\CreateUndangan::route('/create'),
            'edit' => Pages\EditUndangan::route('/{record}/edit'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return 'Tamu Undangan';
    }

    public static function getLabel(): ?string
    {
        return 'Tamu Undangan';
    }
}
