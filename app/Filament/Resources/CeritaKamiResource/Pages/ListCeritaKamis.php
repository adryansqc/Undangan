<?php

namespace App\Filament\Resources\CeritaKamiResource\Pages;

use App\Filament\Resources\CeritaKamiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCeritaKamis extends ListRecords
{
    protected static string $resource = CeritaKamiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
