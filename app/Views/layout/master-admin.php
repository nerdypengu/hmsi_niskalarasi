<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $this->renderSection("title") ?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("pic/niskalarasi-favicon-logo.png") ?>">

    <link href="<?= base_url("main/lib/@fortawesome/fontawesome-free/css/all.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("main/lib/datatables.net-dt/css/jquery.dataTables.min.css") ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <link href="<?= base_url("main/lib/select2/css/select2.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("main/lib/ionicons/css/ionicons.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("main/lib/typicons.font/typicons.css") ?>" rel="stylesheet">
    <link href="<?= base_url("main/lib/prismjs/themes/prism-vs.css") ?>" rel="stylesheet">
    <link href="<?= base_url("main/lib/animate.css/animate.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("main/assets/css/dashforge.min.css") ?>" rel="stylesheet">
    <link href="<?= base_url("main/assets/css/dashforge.demo.css") ?>" rel="stylesheet">

    <style>
        @media only print {
            .aside, .content-header {
                display: none !important;
            }
            .content-body {
                width: auto;
                height: auto;
                overflow: visible;
            }
        }
        .select2-results__option {
            font-size: 12px;
        }
        .content-search {
            overflow: hidden;
            display: inline-block;
            white-space: nowrap;
        }
    </style>
</head>
<body class="page-profile tx-lexend">

<aside class="aside aside-fixed">
    <div class="aside-header">
        <div class="d-flex">
            <a href="<?= base_url("/admin/beranda") ?>" class="aside-logo">
                <img src="<?= base_url("pic/hmsi-mini.jpg") ?>" height="45" alt="" class="aside-logo">
                <img src="<?= base_url("pic/niskalarasi-logo.png") ?>" height="38" alt="" class="aside-logo">
            </a>
        </div>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>

    <div class="aside-body">
        <ul class="nav nav-aside">
            <li class="nav-item <?= (current_url(true)->getSegment(3)) === "beranda" ? "active" : "" ?>">
                <a href="<?= base_url("/admin/beranda") ?>" class="nav-link">
                    <i data-feather="home"></i> <span>Beranda</span></a>
            </li>

            <li class="nav-label mg-t-20">
                Kehadiran Acara
            </li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "hadir") &&
            ((current_url(true)->getSegment(4)) === "dashboard") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/hadir/dashboard") ?>" class="nav-link">
                    <i data-feather="list"></i> <span>Daftar Acara</span></a>
            </li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "hadir") &&
            ((current_url(true)->getSegment(4)) === "rekap") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/hadir/rekap") ?>" class="nav-link">
                    <i data-feather="file-text"></i> <span>Rekap Kehadiran</span></a>
            </li>

            <li class="nav-label mg-t-20">Rapor Fungsionaris</li>
            <?php if(session()->get("id_pengurus") < 40000): ?>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "rapor") &&
            ((current_url(true)->getSegment(4)) === "dashboard") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/rapor/dashboard") ?>" class="nav-link">
                    <i data-feather="book"></i> <span>Daftar Rapor</span></a>
            </li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "rapor") &&
            ((current_url(true)->getSegment(4)) === "isi") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/rapor/isi") ?>" class="nav-link">
                    <i data-feather="edit"></i> <span>Isi Penilaian</span></a>
            </li>
            <?php endif; ?>
            <?php if(session()->get("id_pengurus") >= 40000): ?>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "rapor") &&
            ((current_url(true)->getSegment(4)) === "hasil") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/rapor/hasil") ?>" class="nav-link">
                    <i data-feather="book"></i> <span>Hasil Penilaian</span></a>
            </li>
            <?php endif; ?>

            <li class="nav-label mg-t-20">Sekretariat</li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "sekre") &&
            ((current_url(true)->getSegment(4)) === "piket")  &&
            ((current_url(true)->getSegment(5)) === "dashboard") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/sekre/piket/dashboard") ?>" class="nav-link">
                    <i data-feather="check-square"></i> <span>Kehadiran Piket</span></a>
            </li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "sekre") &&
            ((current_url(true)->getSegment(4)) === "piket") &&
            ((current_url(true)->getSegment(5)) === "riwayat") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/sekre/piket/riwayat") ?>" class="nav-link">
                <i data-feather="clock"></i> <span>Riwayat Piket</span></a>
            </li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "sekre") &&
            ((current_url(true)->getSegment(4)) === "piket")  &&
            ((current_url(true)->getSegment(5)) === "ruangan") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/sekre/piket/ruangan") ?>" class="nav-link">
                    <i data-feather="home"></i> <span>Peminjaman Ruangan</span></a>
            </li>
            <?php if(session()->get("id_pengurus") < 20000): ?>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "sekre") &&
            ((current_url(true)->getSegment(4)) === "piket") &&
            ((current_url(true)->getSegment(5)) === "kontrol") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/sekre/piket/kontrol") ?>" class="nav-link">
                    <i data-feather="trending-up"></i> <span>Kontrol Piket</span></a>
            </li>
            <?php endif; ?>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "sekre") &&
            ((current_url(true)->getSegment(4)) === "data") &&
            ((current_url(true)->getSegment(5)) === "dashboard") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/sekre/data/dashboard") ?>" class="nav-link">
                    <i data-feather="info"></i> <span>Data Mahasiswa</span></a>
            </li>

            <li class="nav-label mg-t-20">Menu Lain</li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "survei") &&
            ((current_url(true)->getSegment(4)) === "dashboard") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/survei/dashboard") ?>" class="nav-link">
                    <i data-feather="bar-chart-2"></i> <span>Daftar Survei</span></a>
            </li>
            <li class="nav-item <?= ((current_url(true)->getSegment(3)) === "akun") &&
            ((current_url(true)->getSegment(4)) === "ubah") ? "active" : "" ?>">
                <a href="<?= base_url("/admin/akun/ubah") ?>" class="nav-link">
                    <i data-feather="user-check"></i> <span>Ubah Profil</span>
                    <span class="badge badge-danger ml-auto animated infinite slower flash" id="profil_lengkap"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="https://tekan.id/" target="_blank" class="nav-link">
                    <i data-feather="link"></i> <span>Ringkas Tautan <i data-feather="external-link" style="height:12px; margin-bottom:5px;"></i></span></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url("/admin/logout") ?>" class="nav-link">
                    <i data-feather="log-out" class="tx-danger"></i> <span>Keluar</span></a>
            </li>
        </ul>
    </div>
</aside>

<div class="content ht-100v pd-0">
    <div class="content-header">
        <div class="form-inline ml-auto mr-auto">
            <div class="bg-info tx-bold tx-white pd-8 d-none d-md-block">Pengumuman</div>
            <div class="content-search bg-gray-200 pd-8 wd-xs-300 wd-md-500 wd-lg-800">
                <div class="running-info"></div>
            </div>
        </div>
        <nav class="nav">
            <div class="dropdown dropdown-profile">
                <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
                    <img src="<?= base_url("pic/avatar.png") ?>" class="avatar avatar-sm rounded-circle" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="width:250px;">
                    <span class="tx-10">Nama Admin:</span>
                    <h5 class="tx-bold" id="nama_user"></h5>
                    <span class="tx-10">Jabatan:</span><br>
                    <span class="" id="jabatan"></span> - <span class="" id="nama_departemen"></span>
                    <hr>
                    <p class="tx-12 tx-color-03 text-center mg-b-0 mt-3"></p>
                    <a href="<?= base_url("admin/logout") ?>" class="dropdown-item">
                        <i data-feather="log-out"></i>Keluar
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div class="content-body">
        <div class="container pd-x-0">
            <?= $this->renderSection("breadcrumbs") ?>
            <div class="d-sm-flex align-items-center justify-content-between mg-b-20">
                <h3><?= $this->renderSection("halaman") ?></h3>
                <?= $this->renderSection("tambah") ?>
            </div>

            <?php if(session()->has("error")): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                    <?= session()->getFlashdata("error") ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if(session()->has("berhasil")): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3 mb-3" role="alert">
                    <?= session()->getFlashdata("berhasil") ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection("konten") ?>

            <footer class="content-footer tx-9 mb-3">
                <div class="order-sm-1 order-lg-1">
                    <span>Copyright &copy; 2023 - <?= date("Y") ?> by <a href="https://arek.its.ac.id/hmsi" class="tx-bold" target="_blank">HMSI ITS</a></span>
                </div>
                <div class="order-sm-3 order-lg-2">
                    <span>Halaman dimuat dalam <b>{elapsed_time}</b> detik</span>
                </div>
                <div class="order-sm-2 order-lg-3">
                    <span>Support by <a href="https://www.tekan.id" class="tx-bold" target="_blank">Tekan.ID</a></span>
                </div>
            </footer>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_hapus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog wd-sm-400" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Konfirmasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-weight-bold tx-14">Apakah kamu yakin ingin menghapus data berikut?</p>
                <p class="font-weight-bold" id="konfirm_hapus"></p>
                <span>Klik tombol <b>HAPUS</b> untuk melanjutkan.</span>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-xs" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-xs" id="btn-delete" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url("main/lib/jquery/jquery.min.js") ?>"></script>
<script src="<?= base_url("main/lib/jqueryui/jquery-ui.min.js") ?>"></script>
<script src="<?= base_url("main/lib/bootstrap/js/bootstrap.bundle.min.js") ?>"></script>
<script src="<?= base_url("main/lib/feather-icons/feather.min.js") ?>"></script>
<script src="<?= base_url("main/lib/parsleyjs/parsley.min.js") ?>"></script>
<script src="<?= base_url("main/lib/perfect-scrollbar/perfect-scrollbar.min.js") ?>"></script>
<script src="<?= base_url("main/lib/prismjs/prism.js") ?>"></script>

<script src="<?= base_url("main/lib/datatables.net-dt/js/dataTables.dataTables.min.js") ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script src="<?= base_url("main/lib/select2/js/select2.full.min.js") ?>"></script>
<script src="<?= base_url("main/lib/chart.js/Chart.bundle.min.js") ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.marquee@1.6.0/jquery.marquee.min.js"></script>

<script src="<?= base_url("main/assets/js/dashforge.js") ?>"></script>
<script src="<?= base_url("main/assets/js/dashforge.aside.js") ?>"></script>

<script type="text/javascript">
    function deleteConfirm(url){
        $("#btn-delete").attr("href", url);
        $("#modal_hapus").modal();
    }

    let profil = $("#profil_lengkap");
    $.ajax({
        type: "GET",
        url: "/ajax/cek_pengurus/" + <?= session()->get("id_pengurus") ?>,
        dataType: "json",

        success: function (data)
        {
            console.log(data);
            $("#nama_user").append(data["nama"]);
            $("#nama_departemen").append(data["nama_departemen"]);
            $("#jabatan").append(data["jabatan"]);
            if (data["nama_panggilan"] === "" || data["id_line"] === "" || data["no_wa"] === "")
            {
                profil.append("baru!");
                profil.addClass("animated flash infinite");
            }
        }
    });

    let info = $(".running-info");
    const jarak = "&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;"
    $.ajax({
        type: "GET",
        url: "/ajax/cek_info",
        dataType: "json",

        success: function (data)
        {
            const akhir = data.length-1;
            $.each(data, function (index, value){
                info.append(value["detail_info"]);
                (index !== akhir) ? info.append(jarak) : null;
            });

            $(".running-info").marquee({
                duration: ($(window).width() < 768) ? 4000 : ($(window).width() < 992) ? 7000 : 10000,
                direction: 'left',
                gap: '100px',
                duplicated: true,
                pauseOnHover: true
            });
        }
    });
</script>

<?php echo $this->renderSection("js") ?>

<script type="text/javascript">
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    $(".select2-container").addClass("tx-12");
</script>
</body>
</html>