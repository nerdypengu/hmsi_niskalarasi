<?php

namespace App\Controllers;

use App\Models\Acara;
use App\Models\Hadir;
use App\Models\Mhs;
use CodeIgniter\HTTP\RedirectResponse;
use DateTime;
use DateTimeZone;


class Presensi extends BaseController
{
    public function index(): string
    {
        return view("presensi/index");
    }

    public function index_kirim(): RedirectResponse
    {
        $kode_acara = $this->request->getPost("kode_acara");

        return ($this->cek_acara($kode_acara)) ?
            redirect()->to(base_url("/$kode_acara")) :
            redirect()->to(base_url("/"))
            ->with("error", "Maaf, kode acara <b>tidak ditemukan!</b><br>Pastikan kode acara sudah benar.");
    }

    public function cek_acara($kode_acara): bool
    {
        $acara = new Acara();
        $query1 = $acara->where("kode_acara", $kode_acara)
            ->first();

        return ($query1 !== null);
    }

    public function acara($kode_acara)
    {
        if ($this->cek_acara($kode_acara)) {
            $acara = new Acara();
            $query1 = $acara->where("kode_acara", $kode_acara)
                ->join("departemen", "acara.id_departemen = departemen.id_departemen")
                ->join("pengurus", "acara.narahubung = pengurus.id_pengurus")
                ->first();

            return ($query1 !== null) ?
                view("presensi/acara", ["data" => $query1]) :
                view("errors/404");
        }
        return redirect()->to(base_url("/"))
            ->with("error", "Maaf, kode acara <b>tidak ditemukan!</b><br>Pastikan kode acara sudah benar.");
    }

    public function hadir(): RedirectResponse
    {
        $kode_acara = $this->request->getPost("form_kode");
        $nrp = $this->request->getPost("form_nrp");
        $waktu = (new DateTime('now'))
            ->setTimezone(new DateTimeZone('Asia/Jakarta'))
            ->format('Y-m-d H:i:s');

        if ($this->cek_status($kode_acara) === 0) {
            if ($this->cek_ganda($kode_acara, $nrp) === 0) {
                $hadir = new Hadir();
                $data1 = [
                    "waktu" => $waktu,
                    "kode_acara" => $kode_acara,
                    "nrp" => $nrp,
                    "keterangan" => null,
                ];
                $query1 = $hadir->insert($data1);

                $this->input_session($kode_acara, $nrp);

                return ($query1 > 0) ?
                    redirect()->to(base_url("/sukses")) :
                    redirect()->to(base_url("/$kode_acara"))
                    ->with("error", "Data gagal disimpan ke Database");
            }
            $this->input_session($kode_acara, $nrp);
            return redirect()->to(base_url("/sukses"));
        }
        return redirect()->to(base_url("/$kode_acara"))
            ->with("error", "Maaf, registrasi acara <b>sudah ditutup!</b><br>Hubungi panitia untuk konfirmasi kehadiran.");
    }

    public function hadir_manual(): RedirectResponse
    {
        $kode_acara = $this->request->getPost("form2_kode");
        $nrp = $this->request->getPost("form2_nrp");
        $nama = $this->request->getPost("form2_nama");
        $angkatan = "20" . substr(($nrp), 4, 2);
        $waktu = (new DateTime('now'))
            ->setTimezone(new DateTimeZone('Asia/Jakarta'))
            ->format('Y-m-d H:i:s');

        if ($this->cek_status($kode_acara) === 0) {
            $mhs = new Mhs();
            $data1 = [
                "nrp" => $nrp,
                "nama" => $nama,
                "angkatan" => $angkatan,
                "keterangan" => null,
            ];
            $query1 = $mhs->insert($data1);

            if ($query1 > 0) {
                $hadir = new Hadir();
                $data2 = [
                    "waktu" => $waktu,
                    "kode_acara" => $kode_acara,
                    "nrp" => $nrp
                ];
                $query2 = $hadir->insert($data2);

                $this->input_session($kode_acara, $nrp);

                if ($query2 > 0) {
                    return redirect()->to(base_url("/sukses"));
                }
            }
            return redirect()->to(base_url("/$kode_acara"))
                ->with("error", "Data gagal disimpan ke Database");
        }
        return redirect()->to(base_url("/$kode_acara"))
            ->with("error", "Maaf, registrasi acara <b>sudah ditutup!</b><br>Hubungi panitia untuk konfirmasi kehadiran.");
    }

    public function acara_panitia($kode_acara)
    {
        if ($this->cek_status($kode_acara) === 0) {
            if ($this->cek_acara($kode_acara)) {
                $acara = new Acara();
                $query1 = $acara->where("kode_acara", $kode_acara)
                    ->join("departemen", "acara.id_departemen = departemen.id_departemen")
                    ->join("pengurus", "acara.narahubung = pengurus.id_pengurus")
                    ->first();

                return ($query1 !== null) ?
                    view("presensi/panitia", ["data" => $query1]) :
                    view("errors/404");
            }
            return redirect()->to(base_url("/admin/hadir/dashboard"))
                ->with("error", "Maaf, kode acara <b>tidak ditemukan!</b> Pastikan mengakses menu ini langsung dari web Admin HMSI!");
        }
        return redirect()->to(base_url("/admin/hadir/dashboard"))
            ->with("error", "Maaf, registrasi acara <b>sudah ditutup!</b> Silakan buka akses kehadiran terlebih dahulu!");
    }

    public function hadir_panitia(): RedirectResponse
    {
        $kode_acara = $this->request->getPost("form_kode");
        $nrp = $this->request->getPost("form_nrp");
        $ket = $this->request->getPost("keterangan");
        $keterangan = ($ket === '') ? null : $ket;
        $waktu = (new DateTime('now'))
            ->setTimezone(new DateTimeZone('Asia/Jakarta'))
            ->format('Y-m-d H:i:s');

        if ($this->cek_status($kode_acara) === 0) {
            if ($this->cek_ganda($kode_acara, $nrp) === 0) {
                $hadir = new Hadir();
                $data1 = [
                    "waktu" => $waktu,
                    "kode_acara" => $kode_acara,
                    "nrp" => $nrp,
                    "keterangan" => $keterangan,
                ];
                $query1 = $hadir->insert($data1);

                $this->input_session($kode_acara, $nrp);

                return ($query1 > 0) ?
                    redirect()->to(base_url("/p/$kode_acara"))
                    ->with("berhasil", "NRP <b>$nrp</b> berhasil hadir.") :
                    redirect()->to(base_url("/p/$kode_acara"))
                    ->with("error", "Data gagal disimpan ke Database");
            }
            return redirect()->to(base_url("/p/$kode_acara"))
                ->with("error", "NRP <b>$nrp</b> sudah hadir.");
        }
        return redirect()->to(base_url("/$kode_acara"))
            ->with("error", "Maaf, registrasi acara <b>sudah ditutup!</b><br>Hubungi panitia untuk konfirmasi kehadiran.");
    }

    public function cek_ganda($kode_acara, $nrp): int
    {
        $hadir = new Hadir();
        $query1 = $hadir->where("kode_acara", $kode_acara)
            ->where("nrp", $nrp)
            ->first();
        return ($query1 === null) ? 0 : 1;
    }

    public function cek_status($kode_acara): int
    {
        $acara = new Acara();
        $query1 = $acara->select("status")
            ->where("kode_acara", $kode_acara)
            ->first();
        return ($query1->status === '0') ? 0 : 1;
    }

    public function input_session($kode_acara, $nrp): void
    {
        (session())->remove("nrp");
        (session())->remove("kode_acara");
        (session())->set("nrp", $nrp);
        (session())->set("kode_acara", $kode_acara);
    }

    public function sukses(): string
    {
        $hadir = new Hadir();
        $nrp = (session())->get("nrp");
        $kode_acara = (session())->get("kode_acara");

        $query1 = $hadir->select(["hadir.nrp", "mhs.nama", "hadir.waktu", "acara.nama_acara", "departemen.nama_departemen", "acara.lokasi", "pengurus.nama_panggilan", "pengurus.id_line", "pengurus.no_wa"])
            ->where("hadir.nrp", $nrp)
            ->where("hadir.kode_acara", $kode_acara)
            ->join("mhs", "mhs.nrp = hadir.nrp")
            ->join("acara", "acara.kode_acara = hadir.kode_acara")
            ->join("departemen", "acara.id_departemen = departemen.id_departemen")
            ->join("pengurus", "acara.narahubung = pengurus.id_pengurus")
            ->first();

        return view("presensi/sukses", ["data" => $query1]);
    }
}
