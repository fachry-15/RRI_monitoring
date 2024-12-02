<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logger extends Model
{
    use HasFactory;

    protected $fillable = ['channel_logger', 'jam_masuk', 'jam_keluar', 'tanggal', 'petugas_id'];

    public function petugas()
    {
        return $this->belongsTo(User::class);
    }
}
