<?php

// app/Models/Absensi.php

namespace App\Models;

use App\Models\Absensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['pegawai_id', 'tanggal', 'jam_masuk', 'jam_keluar', 'jam_istirahat', 'shift'];

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

