<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DokterResource\Pages;
use App\Filament\Resources\DokterResource\RelationManagers;
use App\Models\Dokter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DokterResource extends Resource
{
    protected static ?string $model = Dokter::class;

    protected static ?string $navigationLabel = 'Dokter';
    protected static ?string $navigationGroup = 'Management User';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Informasi Akun')
                    ->relationship('user')
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->label('Nama Dokter')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required(),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn ($livewire) => $livewire instanceof Pages\CreateDokter)  // hanya wajib saat create
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn ($state) => filled($state)),

                        Forms\Components\Hidden::make('role')
                            ->default('dokter'),
                    ])
                    ->columns(2),


                Forms\Components\Section::make('Detail Dokter')
                    ->schema([

                        Forms\Components\Select::make('spesialis')
                            ->label('Spesialis')
                            ->options([
                                'umum' => 'Umum',
                                'gigi' => 'Gigi',
                            ])
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Nonaktif',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nama Dokter')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.email')->label('Email')->searchable(),
                Tables\Columns\BadgeColumn::make('spesialis')
                    ->colors([
                        'primary' => 'umum',
                        'success' => 'gigi',
                    ])
                    ->label('Spesialis'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'aktif',
                        'danger'  => 'nonaktif',
                    ])
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('spesialis')
                    ->options([
                        'umum' => 'Umum',
                        'gigi' => 'Gigi',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non-aktif',
                    ]),
            ])
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDokters::route('/'),
            'create' => Pages\CreateDokter::route('/create'),
            'edit'   => Pages\EditDokter::route('/{record}/edit'),
        ];
    }
}
