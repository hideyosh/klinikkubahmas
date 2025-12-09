<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        .schema([
            Forms\Components\TextInput::make('nama')->required(),
            Forms\Components\TextInput::make('nik')->required(),
            Forms\Components\DatePicker::make('tanggal_lahir')->required(),
            Forms\Components\Select::make('jenis_kelamin')
                ->options([
                    'L' => 'Laki-laki',
                    'P' => 'Perempuan',
                ])->required(),
            Forms\Components\Textarea::make('alamat'),
            Forms\Components\TextInput::make('no_hp'),
        ]);
}


   public static function table(Table $table): Table
{
    return $table
        .columns([
            Tables\Columns\TextColumn::make('nama')->searchable(),
            Tables\Columns\TextColumn::make('nik'),
            Tables\Columns\TextColumn::make('jenis_kelamin'),
            Tables\Columns\TextColumn::make('tanggal_lahir')->date(),
            Tables\Columns\TextColumn::make('no_hp'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
        ])
        .filters([])
        .actions([
            Tables\Actions\EditAction::make(),
        ])
        .bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
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
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}
