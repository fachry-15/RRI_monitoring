<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen'; // Nama tabel di database

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'barang_id',
        'peminjam_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status_peminjaman',
        'keterangan',
    ];

    // Relasi dengan tabel 'barangs'
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi dengan tabel 'peminjams'
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
