<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jaringan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_router', 'ruangan_id', 'ip_router', 'upload', 'download'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function monitor()
    {
        return $this->hasMany(monitor::class);
    }
}
