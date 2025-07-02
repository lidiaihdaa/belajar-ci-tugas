<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?= form_open('keranjang/edit') ?>

<!-- Tabel Keranjang -->
<table class="table datatable table-bordered text-center align-middle">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>Foto</th>
            <th>Harga Asli</th>
            <th>Diskon</th>
            <th>Harga Akhir</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        if (!empty($items)) :
            foreach ($items as $item) : ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td><img src="<?= base_url('img/' . $item['options']['foto']) ?>" width="80px"></td>
                    <td><?= number_to_currency($item['options']['harga_asli'], 'IDR') ?></td>
                    <td><?= number_to_currency($item['options']['diskon'], 'IDR') ?></td>
                    <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                    <td>
                        <input type="number" name="qty<?= $i++ ?>" min="1" value="<?= $item['qty'] ?>" class="form-control text-center">
                    </td>
                    <td><?= number_to_currency($item['subtotal'], 'IDR') ?></td>
                    <td>
                        <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
        <?php endforeach;
        endif; ?>
    </tbody>
</table>

<!-- Total -->
<div class="alert alert-info text-end">
    <strong>Total:</strong> <?= number_to_currency($total, 'IDR') ?>
</div>

<!-- Tombol Aksi -->
<div class="d-flex justify-content-between flex-wrap gap-2">
    <div>
        <button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
        <a href="<?= base_url('keranjang/clear') ?>" class="btn btn-warning">Kosongkan Keranjang</a>
    </div>
    <div>
        <?php if (!empty($items)) : ?>
            <a href="<?= base_url('checkout') ?>" class="btn btn-success">Selesai Belanja</a>
        <?php endif; ?>
    </div>
</div>

<?= form_close() ?>
<?= $this->endSection() ?>
