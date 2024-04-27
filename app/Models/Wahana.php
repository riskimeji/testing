<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wahana extends Model
{
    use HasFactory;
    protected $table = 'wahanas';
    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'status',
        'deskripsi',
        'image'
    ];
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'wahana_id');
    }

    // public function jadwal()
    // {
    //     return $this->belongsTo(Jadwal::class, 'jadwal_id');
    // }


}
