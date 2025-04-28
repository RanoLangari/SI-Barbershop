<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * Get the user (customer) that owns the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the barberman assigned to the reservation.
     */
    public function barberman()
    {
        return $this->belongsTo(User::class, 'id_barberman');
    }

    /**
     * Get the layanan for this reservation.
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    /**
     * Get the pembayaran for this reservation.
     */
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }

    /**
     * Get the kategori layanan for this reservation.
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori_layanan::class, 'kategori_id');
    }

    /**
     * Get the jadwal for this reservation.
     */
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}
