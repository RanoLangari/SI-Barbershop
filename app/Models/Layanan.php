<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    /** @use HasFactory<\Database\Factories\LayananFactory> */
    use HasFactory;

    protected $table = 'layanan';
    protected $fillable = [
        'nama',
        'harga',
        'detail',
        'gambar',
        'kategori_id', // Add this line
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_layanan');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori_layanan::class, 'kategori_id');
    }
}
