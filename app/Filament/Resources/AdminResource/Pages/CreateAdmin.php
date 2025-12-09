<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdmin extends CreateRecord
{
    public function getTitle(): string
    {
        return 'Create Admin';
    }
    public function getBreadcrumb(): string
    {
        return 'Create Admin';
    }

    protected static string $resource = AdminResource::class;
}
