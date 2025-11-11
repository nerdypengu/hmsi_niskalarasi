<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\Admin;
use App\Controllers\Ajax;
use App\Controllers\HadirControl;
use App\Controllers\PiketControl;
use App\Controllers\Presensi;
use App\Controllers\RaporControl;
use App\Controllers\SurveiControl;
use App\Controllers\Webhook;

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('BaseController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function(){ return view("errors/404"); });
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group("/", function ($routes)
{
    $routes->get("", [Presensi::class, "index"]);
    $routes->post("cek", [Presensi::class, "index_kirim"]);
    $routes->post("hadir", [Presensi::class, "hadir"]);
    $routes->post("hadir_manual", [Presensi::class, "hadir_manual"]);
    $routes->get("sukses", [Presensi::class, "sukses"]);

    $routes->group("/",["filter" => "auth"],function ($routes){
        $routes->post("hadir_panitia", [Presensi::class, "hadir_panitia"]);
        $routes->get("p/(:num)", [Presensi::class, "acara_panitia"]);
    });

    $routes->get("/s/(:num)", [Admin::class, "survei_alih"]);
    $routes->get("/(:num)", [Presensi::class, "acara"]);
    $routes->get("/(:segment)",[Admin::class, "tautan_alih"]);
});

$routes->group("ajax", function ($routes)
{
    $routes->get("cek_nrp/(:num)",[Ajax::class, "cek_nrp"]);
    $routes->get("cek_narahubung",[Ajax::class, "cek_narahubung"]);
    $routes->get("cek_pengurus/(:num)",[Ajax::class, "cek_pengurus"]);
    $routes->get("cek_password/(:num)",[Ajax::class, "cek_password"]);
    $routes->get("cek_kontak/(:num)",[Ajax::class, "cek_kontak"]);
    $routes->get("cek_barang",[Ajax::class, "cek_barang"]);
    $routes->get("cek_info",[Ajax::class, "cek_info"]);
});

$routes->group("webhook", function ($routes)
{
    $routes->post("survei",[Webhook::class, "survei"]);
});

$routes->get("admin/login",[Admin::class, "login"]);
$routes->post("admin/login",[Admin::class, "login_cek"]);
$routes->get("admin/logout",[Admin::class, "logout"]);

$routes->group("admin", ['filter' => 'auth'] ,function ($routes)
{
    $routes->get("beranda",[Admin::class, "beranda"]);

    $routes->group("hadir", function ($routes)
    {
        $routes->get("dashboard",[HadirControl::class, "index"]);
        $routes->get("tambah",[HadirControl::class, "tambah"]);
        $routes->post("tambah",[HadirControl::class, "tambah_kirim"]);
        $routes->get("detail/(:num)",[HadirControl::class, "detail"]);
        $routes->get("rekap",[HadirControl::class, "rekap"]);
        $routes->post("rekap/detail",[HadirControl::class, "rekap_detail"]);
        $routes->get("ubah/(:num)",[HadirControl::class, "ubah"]);
        $routes->post("ubah",[HadirControl::class, "ubah_kirim"]);
        $routes->get("hapus/(:num)",[HadirControl::class, "hapus"]);
        $routes->get("tutup/(:num)",[HadirControl::class, "tutup"]);
        $routes->get("buka/(:num)",[HadirControl::class, "buka"]);
    });

    $routes->group("akun",function ($routes)
    {
        $routes->get("ubah",[Admin::class, "akun_ubah"]);
        $routes->post("ubah",[Admin::class, "akun_ubah_kirim"]);
        $routes->post("ubah_pass",[Admin::class, "akun_ubah_pass"]);
    });

    $routes->group("rapor", function ($routes)
    {
        $routes->get("dashboard",[RaporControl::class, "index"]);
        $routes->get("isi",[RaporControl::class, "isi"]);
        $routes->get("isi/auto/(:num)/(:num)",[RaporControl::class, "isi_auto"]);
        $routes->get("isi/detail/(:num)",[RaporControl::class, "isi_detail"]);
        $routes->post("isi/kirim",[RaporControl::class,"isi_kirim"]);
        $routes->get("hasil",[RaporControl::class, "hasil"]);
        $routes->post("hasil",[RaporControl::class, "hasil_post"]);
    });

    $routes->group("survei", function ($routes)
    {
        $routes->get("dashboard",[SurveiControl::class, "index"]);
        $routes->get("detail/(:num)",[SurveiControl::class, "detail"]);
        $routes->get("tambah",[SurveiControl::class, "tambah"]);
        $routes->post("tambah",[SurveiControl::class, "tambah_kirim"]);
    });

    $routes->group("sekre", function ($routes){
        $routes->group("piket", function ($routes){
            $routes->get("dashboard",[PiketControl::class,"index"]);
            $routes->get("riwayat",[PiketControl::class,"riwayat"]);
            $routes->get("ruangan",[PiketControl::class,"ruangan"]);
            $routes->get("kontrol",[PiketControl::class,"kontrol"]);
            $routes->post("hadir",[PiketControl::class,"hadir"]);
            $routes->post("pulang",[PiketControl::class,"pulang"]);
            $routes->post("ubah",[PiketControl::class,"ubah"]);
            $routes->post("ruangan/tambah",[PiketControl::class,"tambahPeminjaman"]); 

        });

        $routes->group("data", function ($routes){
            $routes->get("dashboard",[Admin::class, "sekre_data_dashboard"]);
        });
    });
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
