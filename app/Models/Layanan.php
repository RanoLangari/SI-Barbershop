<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'layanan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'detail',
        'harga',
        'durasi',
        'kategori_id',
        'gambar',
    ];

    /**
     * Get the reservations for this service.
     */
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_layanan');
    }

    /**
     * Get the kategori this layanan belongs to.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori_layanan::class, 'kategori_id');
    }
}