<?php

namespace App\Filament\Resources\RMedisResource\Pages;

use App\Filament\Resources\RMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRMedis extends EditRecord
{
    protected static string $resource = RMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
