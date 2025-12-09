<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dokter extends Model
{
    protected $fillable = [
        'user_id',
        'spesialis',
        'status'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
