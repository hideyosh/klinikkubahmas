<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakLanjut extends Model
{
    protected $fillable = [
        'rekam_medis_id',
        'tanggal_lanjut',
        'deskripsi_tindak_lanjut',
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RMedis::class, 'rekam_medis_id');
    }
}
