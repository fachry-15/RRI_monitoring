<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ticket',
        'barang_id',
        'jenis',
        'diagnosa',
        'deskripsi',
        'lampiran',
    ];

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
}
