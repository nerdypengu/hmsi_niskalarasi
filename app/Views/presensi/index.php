<?= $this->extend("layout/master-presensi") ?>

<?= $this->section("title") ?>
Kehadiran Acara HMSI
<?= $this->endSection() ?>

<?= $this->section("konten") ?>
<?php if (session()->has("error")): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3 animated fadeInDown" role="alert">
        <?= session()->getFlashdata("error") ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
<?php endif; ?>

<form action="<?= base_url("/cek") ?>" method="post" data-parsley-validate class="animated fadeInUp">
    <div class="form-group">
        <label for="kode_acara" class="tx-bold">Kode Acara<span class="tx-danger">*</span></label>
        <input id="kode_acara" name="kode_acara" type="text" class="form-control" placeholder="Masukkan kode acara" required data-parsley-required-message="Kode Acara wajib diisi!">
    </div>
    <button type="submit" class="btn btn-block btn-primary btn-icon">
        <i data-feather="search"></i> <span>Cek Kode Acara</span>
    </button>
</form>

<?= $this->endSection() ?>