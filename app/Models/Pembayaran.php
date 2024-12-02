<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\PembayaranFactory> */
    use HasFactory;

    protected $table = 'pembayaran';
    protected $fillable = [
        'transaksi_id',
        'status',
        'jumlah',
        'metode_pembayaran',
        'tanggal_pembayaran'
    ];

    public function reservasi()
    {
        return $this->hasOne(Reservasi::class, 'id_pembayaran');
    }
}
