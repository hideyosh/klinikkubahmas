<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
        protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Pasien';
    protected static ?string $pluralLabel = 'Pasien';
    protected static ?string $navigationGroup = 'Data Pasien';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pasien')
                    ->label('Nama Pasien'),

                Forms\Components\TextInput::make('nik')
                    ->label('Nomor Induk Kependudukan (NIK)'),

                    Forms\Components\Select::make('golongan_darah')
                    ->label('Golongan Darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                    ])
                    ->nullable(),

                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->nullable(),

                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->nullable(),

                Forms\Components\TextInput::make('telepon')
                    ->label('Telepon')
                    ->maxLength(20)
                    ->nullable(),

                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(3)
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pasien')
                    ->label('Nama Pasien')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(function ($state) {
                        return $state === 'L' ? 'Laki-laki' : 'Perempuan';
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('golongan_darah')
                    ->label('Gol. Darah')
                    ->sortable(),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->label('Plih Jenis Kelamin'),
                Tables\Filters\SelectFilter::make('golongan_darah')
                    ->multiple()
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                    ])
                    ->label('Pilih Golongan Darah'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Pasien')
                    ->modalDescription('Apakah Anda yakin ingin menghapus data pasien ini? Tindakan ini tidak dapat dibatalkan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'view' => Pages\ViewPasien::route('/{record}/'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}
