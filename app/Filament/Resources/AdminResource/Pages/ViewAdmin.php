<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Notifications\Action;
use Filament\Infolists\Components;

class ViewAdmin extends ViewRecord
{
    protected static string $resource = AdminResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Components\Section::make('Detail Admin')
                ->schema([
                    Components\TextEntry::make('name')
                    ->label('Nama Admin'),

                    Components\TextEntry::make('email')
                        ->label('Email'),
                ])->columns(2),
            ]);
    }
}
