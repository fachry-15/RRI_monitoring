<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monitor extends Model
{
    use HasFactory;

    protected $fillable = ['jaringan_id', 'kondisi', 'petugas_id', 'status'];

    public function jaringan()
    {
        return $this->belongsTo(jaringan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class);
    }
}
