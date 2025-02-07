<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    /** @use HasFactory<\Database\Factories\ReservasiFactory> */
    use HasFactory;

    protected $table = 'reservasi';
    protected $fillable = [
        'kategori_id',
        'id_layanan',
        'id_barberman',
        'id_user',
        'id_jadwal',
        'id_pembayaran',
        'tanggal_reservasi',
        'status'
    ];


    public function kategori_layanan()
    {
        return $this->belongsTo(Kategori_layanan::class, 'kategori_id');
    }


    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    public function barberman()
    {
        return $this->belongsTo(User::class, 'id_barberman');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_reservasi');
    }
}
