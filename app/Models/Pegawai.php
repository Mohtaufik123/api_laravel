<?php

namespace App\Models;

use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nomor_telepon', 'email'];

    // Relasi ke Absensi
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
