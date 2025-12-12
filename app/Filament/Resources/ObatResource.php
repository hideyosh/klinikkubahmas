<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObatResource\Pages;
use App\Models\Obat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationGroup = 'Obat & Inventaris';
    protected static ?string $navigationLabel = 'Obat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_obat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('kategori')
                    ->required()
                    ->options([
                        'tablet' => 'Tablet',
                        'sirup' => 'Sirup',
                        'kapsul' => 'Kapsul',
                        'salep' => 'Salep',
                    ]),

                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->minValue(0)
                    ->default(0),

                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->minValue(0)
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_obat')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('kategori')->sortable(),
                Tables\Columns\TextColumn::make('stok')->sortable(),
                Tables\Columns\TextColumn::make('harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Dibuat')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObats::route('/'),
            'create' => Pages\CreateObat::route('/create'),
            'edit' => Pages\EditObat::route('/{record}/edit'),
        ];
    }
}
