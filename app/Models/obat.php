<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    // Kolom yang boleh diisi secara mass-assignment
    protected $fillable = [
        'nama_obat',
        'kategori',
        'stok',
        'harga',
    ];

    // Casting otomatis
    protected $casts = [
        'stok' => 'integer',
        'harga' => 'float',
    ];
    public function RMedis()
    {
        return $this->hasMany(RMedis::class, 'id', 'nama_obat');
    }
}