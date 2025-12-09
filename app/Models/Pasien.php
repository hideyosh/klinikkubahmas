<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasiens';

    protected $fillable = [
        'golonganDarah',
        'tinggiBadan',
        'beratBadan',
        'tanggalLahir',
        'jenis_kelamin',
        'alamat',
        'telepon',
    ];
}
