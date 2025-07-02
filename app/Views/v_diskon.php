<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Flashdata -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (isset($validation) && $validation->hasError('tanggal')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $validation->getError('tanggal') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Banner Diskon Hari Ini -->
<?php if ($todayDiskon): ?>
    <div class="alert alert-success fw-bold text-center">
        Hari ini ada diskon Rp <?= number_format($todayDiskon->nominal, 0, ',', '.') ?> per item
    </div>
<?php endif; ?>

<!-- Tombol Tambah -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>

<!-- Tabel Diskon -->
<table class="table datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Tanggal</th>
            <th>Nominal (Rp)</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($diskon as $index => $row): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $row->tanggal ?></td>
                <td><?= number_format($row->nominal, 0, ',', '.') ?></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $row->id ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('diskon/hapus/' . $row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editModal-<?= $row->id ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?= base_url('diskon/edit') ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="id" value="<?= $row->id ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Diskon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" value="<?= $row->tanggal ?>" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Nominal (Rp)</label>
                                    <input type="number" name="nominal" value="<?= $row->nominal ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Edit Modal -->
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('diskon/tambah') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Nominal (Rp)</label>
                        <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Add Modal -->

<?= $this->endSection() ?>
