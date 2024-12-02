<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalFactory> */
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'id_barberman',
        'tanggal',
        'jam_mulai',
        'jam_selesai',

    ];

    public function barberman()
    {
        return $this->belongsTo(User::class, 'id_barberman', 'id');
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_jadwal');
    }
}
