<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_layanan extends Model
{
    /** @use HasFactory<\Database\Factories\Kategori_layananFactory> */
    use HasFactory;

    protected $table = 'kategori_layanan';
    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
    ];

    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'kategori_id'); // Update the foreign key
    }
}
