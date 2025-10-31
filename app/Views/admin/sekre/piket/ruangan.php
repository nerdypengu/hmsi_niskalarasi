<?= $this->extend("layout/master-admin") ?>
<?php if (isset($data, $breadcrumbs)): ?>

  <?= $this->section("title") ?>Admin HMSI | Sekretariat | Piket | Peminjaman<?= $this->endSection() ?>

  <?= $this->section("breadcrumbs") ?><?= $breadcrumbs ?><?= $this->endSection() ?>

  <?= $this->section("halaman") ?>Daftar Peminjaman Ruangan<?= $this->endSection() ?>

  <?= $this->section("konten") ?>

  <!-- ✅ Tombol Tambah -->
  <div class="mb-3 text-right">
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
      <i data-feather="plus"></i> Tambah Peminjaman
    </button>
  </div>

  <!-- ✅ Tabel -->
  <table id="tabel-peminjaman" class="table table-hover table-bordered">
    <thead>
      <tr class="tx-center tx-bold">
        <th>No.</th>
        <th>Nama Kegiatan</th>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
        <th>Jam Akhir</th>
        <th>Departemen</th>
        <th>Penanggung Jawab</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $i => $d): ?>
        <tr>
          <td class="align-middle tx-center tx-bold"><?= $i + 1 ?></td>
          <td class="align-middle"><?= esc($d['nama_kegiatan']) ?></td>
          <td class="align-middle tx-center"><?= esc($d['tanggal']) ?></td>
          <td class="align-middle tx-center"><?= esc($d['jam_mulai']) ?></td>
          <td class="align-middle tx-center"><?= esc($d['jam_akhir']) ?></td>
          <td class="align-middle"><?= esc($d['nama_departemen']) ?></td>
          <td class="align-middle"><?= esc($d['nama_panggilan']) ?></td>
          <td class="align-middle tx-center">
            <?php if ($d['status'] === 'sedang'): ?>
              <span class="badge badge-warning">Sedang Dipinjam</span>
            <?php elseif ($d['status'] === 'selesai'): ?>
              <span class="badge badge-success">Selesai</span>
            <?php else: ?>
              <span class="badge badge-secondary"><?= esc($d['status']) ?></span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- ✅ Modal Tambah -->
  <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <form action="<?= base_url('admin/sekre/piket/ruangan/tambah') ?>" method="post">
          <?= csrf_field() ?>
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="modalTambahLabel">Tambah Peminjaman Ruangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
          </div>

          <div class="modal-body">
            <div class="form-group">
              <label class="tx-bold">Nama Kegiatan</label>
              <input type="text" name="nama_kegiatan" class="form-control" required>
            </div>
            <div class="form-group">
              <label class="tx-bold">Tanggal</label>
              <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label class="tx-bold">Jam Mulai</label>
                  <input type="time" name="jam_mulai" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="tx-bold">Jam Akhir</label>
                  <input type="time" name="jam_akhir" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="departemen" class="tx-bold">Departemen</label>
              <!-- <input type="text" name="departemen" class="form-control" required> -->
              <select name="departemen" id="departemen" class="form-control">
                <option selected disabled>Pilih Departemen</option>
                <?php foreach ($departemens as $i => $departemen): ?>
                  <option value=<?= $departemen->id_departemen; ?>><?= $departemen->nama_departemen; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary btn-sm">
              <i data-feather="save"></i> Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?= $this->endSection() ?>

  <?= $this->section("js") ?>
  <script>
    $('#tabel-peminjaman').DataTable({
      order: [
        [0, 'asc']
      ],
      columnDefs: [{
        targets: 7,
        orderable: true
      }],
      <?= $this->include("layout/datatable.txt") ?>
    });

    $('#modalTambah').on('shown.bs.modal', function() {
      feather.replace();
    });
  </script>
  <?= $this->endSection() ?>

<?php endif; ?>