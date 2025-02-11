<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refund';

    protected $fillable = [
        'id_reservasi',
        'id_pembayaran',
        'alasan',
        'status',
        'bukti',
        'merchant',
        'address_refund',
        'address_name',
        'created_at',
        'updated_at'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}
