<?php

namespace App\Filament\Resources\DokterResource\Pages;

use App\Filament\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDokter extends CreateRecord
{
    protected static string $resource = DokterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create user
        $user = \App\Models\User::create([
            'name'     => $data['user']['name'],
            'email'    => $data['user']['email'],
            'password' => bcrypt($data['user']['password']),
            'role'     => 'dokter',
        ]);

        // Set user_id ke tabel Dokter
        $data['user_id'] = $user->id;

        // Hapus data nested 'user'
        unset($data['user']);

        return $data;
    }

    public function getTitle(): string
    {
        return 'Create Dokter';
    }
}
