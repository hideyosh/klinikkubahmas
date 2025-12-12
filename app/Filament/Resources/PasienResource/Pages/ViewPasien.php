<?php

namespace App\Filament\Resources\PasienResource\Pages;

use App\Filament\Resources\PasienResource;
use Filament\Actions;
use Filament\Infolists\Infolist;
use Carbon\Carbon;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Notifications\Action;
use Filament\Infolists\Components;

class ViewPasien extends ViewRecord
{
    protected static string $resource = PasienResource::class;

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
            Components\Section::make('Detail Pasien')
                ->schema([
                    Components\TextEntry::make('nama_pasien')
                    ->label('Nama Pasien'),

                    Components\TextEntry::make('nik')
                        ->label('NIK'),

                    Components\TextEntry::make('jenis_kelamin')
                        ->label('Jenis Kelamin')
                        ->formatStateUsing(fn ($state) => $state === 'L' ? 'Laki-laki' : 'Perempuan'),

                    Components\TextEntry::make('tanggal_lahir')
                        ->label('Tanggal Lahir')
                        ->formatStateUsing(fn ($state) =>
                            $state
                                ? Carbon::parse($state)->format('d-m-Y')
                                : 'N/A'
                        ),

                    Components\TextEntry::make('golongan_darah')
                        ->label('Golongan Darah'),

                    Components\TextEntry::make('telepon')
                        ->label('Telepon')
                        ->copyable(),
                ])
                ->columns(2),
        ]);
    }
}
