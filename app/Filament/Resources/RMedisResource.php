<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RMedisResource\Pages;
use App\Filament\Resources\RMedisResource\RelationManagers;
use App\Models\RMedis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RMedisResource extends Resource
{
    protected static ?string $model = RMedis::class;
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Rekam Medis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\Section::make('Rekam Medis Informasi')
                    ->schema([ 
                        Forms\Components\TextInput::make('Pasien')
                            ->required()
                            ->maxLength(255),

                        
                        Forms\Components\Select::make('obat_id')
                            ->relationship('obat', 'nama_obat')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama_obat')
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        Forms\Components\TextInput::make('Diagnosa_Penyakit')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('Tindak_Lanjut')
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('tahun_Periksa')
                            ->numeric()
                            ->minValue(2001)
                            ->maxValue(date('Y'))
                            ->step(1),
                        
                        Forms\Components\Select::make('status')
                            ->options([
                                'sudah diperiksa' => 'sudah diperiksa',
                                'belum diperiksa' => 'belum diperiksa',
                            ])
                            ->required()
                            ->default('belum diperiksa'),
                    ])
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([    
                Tables\Columns\TextColumn::make('Pasien')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable(),
            
                Tables\Columns\TextColumn::make('Diagnosa_Penyakit')
                    ->searchable()
                    ->sortable(),
                
               Tables\Columns\TextColumn::make('obat.nama_obat') 
                    ->label('Nama Obat')
                    ->searchable()
                    ->sortable(),
                
                 Tables\Columns\TextColumn::make('Tindak_Lanjut')
                    ->label('Tindak Lanjut')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('tahun_Periksa')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                         'success' => 'sudah diperiksa',
                         'warning' => 'belum diperiksa',
                    ])
                    ->icons([
                        'heroicon-o-check-circle' => 'sudah diperiksa',
                        'heroicon-o-clock' => 'belum diperiksa',
                    ]),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'sudah diperiksa' => 'sudah diperiksa',
                        'belum diperiksa' => 'belum diperiksa',
                    ]),
                
                Tables\Filters\SelectFilter::make('tahun_Periksa')
                    ->options(function () {
                        $currentYear = date('Y');
                        $years = [];
                        for ($year = $currentYear; $year >= 2021; $year--) {
                            $years[$year] = $year;
                        }
                        return $years;
                    })
                    ->searchable(),
                
                Tables\Filters\SelectFilter::make('obat')
        // Menggunakan relasi 'obat', dan mengambil label dari kolom 'nama_obat'
                    ->relationship('obat', 'nama_obat') // <--- DIKOREKSI
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
    ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRMedis::route('/'),
            'create' => Pages\CreateRMedis::route('/create'),
            'view' => Pages\ViewRMedis::route('/{record}'),
            'edit' => Pages\EditRMedis::route('/{record}/edit'),
        ];
    }
}
