<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pembayaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaksi_id',
        'status',
        'jumlah',
        'metode_pembayaran',
        'tanggal_pembayaran'
    ];

    /**
     * Get the reservasi associated with the payment.
     */
    public function reservasi()
    {
        // Based on the migration file, we can see that the relationship is reverse
        // Reservasi has an id_pembayaran field that points to this model
        return $this->hasOne(Reservasi::class, 'id_pembayaran');
    }
}
