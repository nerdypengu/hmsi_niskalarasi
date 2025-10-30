<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_kegiatan',
        'tanggal',
        'jam_mulai',
        'jam_akhir',
        'departemen',
        'penanggung_jawab',
        'status'
    ];

    // 🔍 Cek apakah waktu yang diajukan bentrok dengan jadwal yang ada
    public function isAvailable($tanggal, $mulai, $akhir)
    {
        return $this->where('tanggal', $tanggal)
            ->groupStart()
            ->where("$mulai BETWEEN jam_mulai AND jam_akhir", null, false)
            ->orWhere("$akhir BETWEEN jam_mulai AND jam_akhir", null, false)
            ->groupEnd()
            ->countAllResults() === 0;
    }
}
