<!-- Views/admin/kategori.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Buku - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #212529;
            padding: 20px;
            color: white;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background-color: #343a40;
            border-radius: 5px;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .logout-btn {
            position: absolute;
            bottom: 20px;
            width: calc(100% - 40px);
        }
    </style>
</head>
<body class="bg-dark text-light">
    <!-- Sidebar -->
    <div class="sidebar">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a>
        <a href="<?= base_url('/admin/buku'); ?>">Data Buku</a>
        <a href="#" class="active">Kategori</a>
        <a href="<?= base_url('/admin/users'); ?>">Data Anggota</a>
        <a href="#">Data Peminjam</a>
        <a href="<?= base_url('admin/data-ulasan'); ?>">Data Ulasan</a>
        <a href="#">Laporan</a>
        <a href="<?= base_url('logout') ?>" class="btn btn-outline-danger logout-btn">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Kategori Buku</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                    <i class="bi bi-plus-circle"></i> Tambah Kategori
                </button>
            </div>

            <!-- Table -->
            <div class="card bg-dark border-secondary">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Buku</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($kategoriBuku as $kategori): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $kategori['NamaKategori'] ?></td>
                                    <td><?= $kategori['jumlah_buku'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                                data-bs-target="#editKategoriModal<?= $kategori['KategoriID'] ?>">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                                data-bs-target="#hapusKategoriModal<?= $kategori['KategoriID'] ?>">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/kategori/save') ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control bg-dark text-light" id="namaKategori" name="namaKategori" required>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <?php foreach($kategoriBuku as $kategori): ?>
    <div class="modal fade" id="editKategoriModal<?= $kategori['KategoriID'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/kategori/update/'.$kategori['KategoriID']) ?>" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control bg-dark text-light" id="namaKategori" 
                                   name="namaKategori" value="<?= $kategori['NamaKategori'] ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal Hapus Kategori -->
    <?php foreach($kategoriBuku as $kategori): ?>
    <div class="modal fade" id="hapusKategoriModal<?= $kategori['KategoriID'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus kategori "<?= $kategori['NamaKategori'] ?>"?
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('admin/kategori/delete/'.$kategori['KategoriID']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>