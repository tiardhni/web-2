<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman'; // Pastikan ini juga

    protected $fillable = [
        'pegawai_id',
        'ruang_id',
        'tanggal',
        'jam_mulai',
        'jam_akhir',
        'keterangan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }
}
