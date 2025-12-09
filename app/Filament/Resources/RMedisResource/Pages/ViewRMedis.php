<?php

namespace App\Filament\Resources\RMedisResource\Pages;

use App\Filament\Resources\RMedisResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ViewRMedis extends ViewRecord
{
    protected static string $resource = RMedisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Rekam Medis')
                    ->schema([
                        TextEntry::make('Pasien')
                            ->label('pasien')
                            ->weight('bold'),

                        TextEntry::make('obat.nama_obat')
                            ->label('Obat'),

                        TextEntry::make('Diagnosa_Penyakit'),

                        TextEntry::make('Tindak_Lanjut'),

                        TextEntry::make('tahun_Periksa'),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'sudah diperiksa' => 'success',
                                'belum diperiksa' => 'warning',
                            }),

                        TextEntry::make('created_at')->dateTime(),
                        TextEntry::make('updated_at')->dateTime(),

                    ])
                    ->columns(2),
            ]);
    }
}
