<?php

namespace App\Filament\Imports;

use App\Models\Undangan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class UndanganImporter extends Importer
{
    protected static ?string $model = Undangan::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('pronoun')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('slug')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Undangan
    {
        // return Undangan::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Undangan();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your undangan import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
