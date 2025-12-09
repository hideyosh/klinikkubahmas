<?php

namespace App\Filament\Resources\RMedisResource\Pages;

use App\Filament\Resources\RMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRMedis extends ListRecords
{
    protected static string $resource = RMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
