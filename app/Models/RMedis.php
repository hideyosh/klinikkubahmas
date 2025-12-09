<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'obat_id',
        'Pasien', // Ini sebenarnya nama pasien, bukan foreign key.
        'Diagnosa_Penyakit',
        'Tindak_Lanjut',
        'tahun_Periksa',
        'status',
    ];

    protected $casts = [
        'tahun_Periksa' => 'integer',
    ];
    
    
    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'obat_id', 'id');
    }
    public function tindakLanjuts()
{
    return $this->hasMany(TindakLanjut::class, 'rekam_medis_id');
}
}