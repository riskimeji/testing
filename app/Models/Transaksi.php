<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';

    protected $fillable = [
        'kode_transaksi',
        'wahana_id',
        'jadwal_id',
        'user_id',
        'payment_id',
        'total_bayar',
        'tanggal_pesan',
        'bukti_pembayaran',
        'jumlah_tiket',
        'kode_tiket',
        'status',
    ];

    public function wahana()
    {
        return $this->belongsTo(Wahana::class, 'wahana_id');
    }

    /**
     * Mendapatkan pengguna yang melakukan pemesanan.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

}
