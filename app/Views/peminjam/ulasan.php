<?= $this->extend('peminjam/layout/peminjam_template'); ?>
<?= $this->section('content'); ?>
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-light mb-0">Ulasan Saya</h2>
            <p class="text-muted">Kelola ulasan buku yang telah Anda berikan</p>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show bg-success text-white border-0" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session()->getFlashdata('success'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show bg-danger text-white border-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= session()->getFlashdata('error'); ?>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="card bg-dark text-white border-secondary">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr class="text-light">
                            <th class="border-0">No</th>
                            <th class="border-0">Judul Buku</th>
                            <th class="border-0">Ulasan</th>
                            <th class="border-0">Rating</th>
                            <th class="border-0">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($ulasan as $u) : ?>
                            <tr>
                                <td class="align-middle"><?= $i++; ?></td>
                                <td class="align-middle">
                                    <span class="fw-bold"><?= $u['Judul']; ?></span>
                                </td>
                                <td class="align-middle text-wrap" style="max-width: 300px;">
                                    <?= $u['Ulasan']; ?>
                                </td>
                                <td class="align-middle">
                                    <?php
                                    $fullStars = floor($u['Rating'] / 2); // Menghitung bintang penuh
                                    $halfStars = ($u['Rating'] % 2) ? 1 : 0; // Menghitung bintang setengah
                                    ?>
                                    <?php for ($j = 1; $j <= 5; $j++) : ?>
                                        <?php if ($j <= $fullStars) : ?>
                                            <i class="fas fa-star text-warning"></i> <!-- Bintang penuh -->
                                        <?php elseif ($j == $fullStars + 1 && $halfStars) : ?>
                                            <i class="fas fa-star-half-alt text-warning"></i> <!-- Bintang setengah -->
                                        <?php else : ?>
                                            <i class="far fa-star text-muted"></i> <!-- Bintang kosong -->
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </td>
                                <td class="align-middle">
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal<?= $u['UlasanID']; ?>">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>
                                        <a href="<?= base_url('ulasan/hapus/' . $u['UlasanID']); ?>"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Ulasan -->
                            <div class="modal fade" id="editModal<?= $u['UlasanID']; ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-dark text-light">
                                        <div class="modal-header border-secondary">
                                            <h5 class="modal-title">
                                                <i class="fas fa-edit me-2"></i>Edit Ulasan
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="<?= base_url('ulasan/update/' . $u['UlasanID']); ?>" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Judul Buku</label>
                                                    <input type="text" class="form-control bg-secondary text-white" value="<?= $u['Judul']; ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Ulasan</label>
                                                    <textarea class="form-control bg-dark text-light border-secondary"
                                                        name="ulasan"
                                                        rows="3"
                                                        required><?= $u['Ulasan']; ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Rating</label>
                                                    <select class="form-select bg-dark text-light border-secondary" name="rating" required>
                                                        <?php for ($r = 1; $r <= 10; $r++) : ?>
                                                            <option value="<?= $r; ?>" <?= ($r == $u['Rating']) ? 'selected' : ''; ?>>
                                                                <?= $r; ?> Bintang
                                                            </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-secondary">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i>Tutup
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (empty($ulasan)) : ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-book-open fa-3x mb-3"></i>
                                        <p class="mb-0">Belum ada ulasan</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    body {
        background-color: #212529;
        color: #fff;
    }

    .table-dark {
        --bs-table-bg: transparent;
    }

    .modal-backdrop.show {
        opacity: 0.8;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #212529;
        color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .btn-group .btn {
        margin: 0 2px;
    }

    .alert {
        border-radius: 10px;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
</style>
<?= $this->endSection(); ?>