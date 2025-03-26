<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    /** @use HasFactory<\Database\Factories\UlasanFactory> */
    use HasFactory;

    protected $table = 'ulasan';
    protected $fillable = [
        'id_reservasi',
        'id_user',
        'ulasan',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
