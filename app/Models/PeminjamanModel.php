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
        'id_departemen',
        'id_pengurus',
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

    public function getAllWithRelations()
    {
        return $this->select('peminjaman.*, departemen.nama_departemen, pengurus.nama_panggilan')
            ->join('departemen', 'departemen.id_departemen = peminjaman.id_departemen', 'left')
            ->join('pengurus', 'pengurus.id_pengurus = peminjaman.id_pengurus', 'left')
            ->orderBy('tanggal', 'ASC')
            ->findAll();
    }
}
