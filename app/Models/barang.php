<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $table = 'barangs'; // Nama tabel di database

    // Kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'nama_barang',
        'merek',
        'tipe',
        'kode_barang',
        'Processor',
        'RAM',
        'Storage',
        'kategori_id',
        'kantor_id',
        'petugas_id',
        'ruangan_id',
        'bukti_gambar',
        'tanggal_masuk',
        'Tahun_perolehan',
        'kondisi',
        'sumber_barang',
        'lampiran',
    ];

    // Relasi dengan tabel 'kategoris'
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi dengan tabel 'kantors'
    public function kantor()
    {
        return $this->belongsTo(Kantor::class);
    }

    // Relasi dengan tabel 'petugas'
    public function petugas()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan tabel 'ruangans'
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
