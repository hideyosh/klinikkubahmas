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
    protected static ?string $navigationLabel = 'Data Pasien';
    protected static ?string $pluralLabel = 'Pasien';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('golonganDarah')
                    ->label('Golongan Darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                    ])
                    ->nullable(),

                Forms\Components\TextInput::make('tinggiBadan')
                    ->label('Tinggi Badan (cm)')
                    ->numeric()
                    ->nullable(),

                Forms\Components\TextInput::make('beratBadan')
                    ->label('Berat Badan (kg)')
                    ->numeric()
                    ->nullable(),

                Forms\Components\DatePicker::make('tanggalLahir')
                    ->label('Tanggal Lahir')
                    ->nullable(),

                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->nullable(),

                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->rows(3)
                    ->nullable()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('telepon')
                    ->label('Telepon')
                    ->maxLength(20)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('golonganDarah')
                    ->label('Gol. Darah'),

                Tables\Columns\TextColumn::make('tinggiBadan')
                    ->label('TB (cm)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('beratBadan')
                    ->label('BB (kg)')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggalLahir')
                    ->label('Tanggal Lahir')
                    ->date(),

                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('JK'),

                Tables\Columns\TextColumn::make('telepon')
                    ->label('Telepon'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}
