<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien'; // Pastikan nama tabel benar
    protected $guarded = ['id']; // Memungkinkan mass assignment pada kolom lain

    // Pasien memiliki satu User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Pasien memiliki banyak alergi
    public function alergi()
    {
        return $this->hasMany(AlergiPasien::class);
    }
}