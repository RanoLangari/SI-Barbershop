<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'kategori_id',
        'id_layanan',
        'id_barberman',
        'nama_pemesan',
        'metode_pembayaran',
        'tanggal',
        'jam',
    ];

    public function kategori()
    {
        return $this->belongsTo(\App\Models\Kategori_Layanan::class, 'kategori_id');
    }

    public function layanan()
    {
        return $this->belongsTo(\App\Models\Layanan::class, 'id_layanan');
    }

    public function barberman()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_barberman');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }
}
