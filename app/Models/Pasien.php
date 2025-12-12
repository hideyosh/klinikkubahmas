<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'nama_pasien',
        'nik',
        'golongan_darah',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'telepon',
    ];

    public function kunjungan() : HasMany {
        return $this->hasMany(Kunjungan::class);
    }
}
