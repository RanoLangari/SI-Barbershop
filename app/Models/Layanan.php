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
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_layanan');
    }
}
