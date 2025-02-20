<?php

namespace App\Filament\Resources\CeritaKamiResource\Pages;

use App\Filament\Resources\CeritaKamiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCeritaKami extends EditRecord
{
    protected static string $resource = CeritaKamiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
