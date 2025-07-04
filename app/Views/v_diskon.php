<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')) : ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Diskon
</button>

<!-- Table -->
<table class="table datatable mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Nominal (Rp)</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($diskon as $index => $row) : ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= esc($row['tanggal']) ?></td>
                <td><?= number_format($row['nominal'], 0, '', '') ?></td>
                <td>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-<?= $row['id'] ?>">Ubah</button>
                    <a href="<?= base_url('diskon/delete/' . $row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-<?= $row['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?= base_url('diskon/update/' . $row['id']) ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Diskon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label for="nominal">Nominal (Rp)</label>
                                    <input type="number" class="form-control" name="nominal" value="<?= esc($row['nominal']) ?>" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?= esc($row['tanggal']) ?>" readonly>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Edit Modal -->

        <?php endforeach ?>
    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('diskon/store') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="nominal">Nominal (Rp)</label>
                        <input type="number" class="form-control" name="nominal" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
