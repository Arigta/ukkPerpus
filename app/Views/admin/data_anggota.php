<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #e0e0e0;
        }
        .main-container {
            background-color: #2d2d2d;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            padding: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .page-title {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #404040;
        }
        .btn-custom-add {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-custom-add:hover {
            background-color: #45a049;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            color: #e0e0e0;
        }
        .table thead {
            background-color: #1e1e1e;
            color: #fff;
        }
        .table tbody tr {
            background-color: #333333;
        }
        .table tbody tr:hover {
            background-color: #404040;
        }
        .table td, .table th {
            border-color: #404040;
        }
        .btn-action {
            padding: 5px 10px;
            margin: 2px;
            border-radius: 6px;
            border: none;
        }
        .btn-action.btn-primary {
            background-color: #2196F3;
        }
        .btn-action.btn-danger {
            background-color: #f44336;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .modal-content {
            background-color: #2d2d2d;
            border-radius: 15px;
            border: 1px solid #404040;
        }
        .modal-header {
            background-color: #1e1e1e;
            color: #fff;
            border-bottom: 1px solid #404040;
            border-radius: 15px 15px 0 0;
        }
        .modal-header .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .form-control, .form-select {
            background-color: #333333;
            border: 1px solid #404040;
            color: #e0e0e0;
            border-radius: 8px;
            padding: 10px 15px;
        }
        .form-control:focus, .form-select:focus {
            background-color: #404040;
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
            color: #fff;
        }
        .form-select option {
            background-color: #333333;
            color: #e0e0e0;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #333333;
            border: none;
        }
        .alert-success {
            background-color: rgba(76, 175, 80, 0.2);
            color: #4CAF50;
        }
        .alert-danger {
            background-color: rgba(244, 67, 54, 0.2);
            color: #f44336;
        }
        .badge.bg-primary {
            background-color: #2196F3 !important;
        }
        .badge.bg-success {
            background-color: #4CAF50 !important;
        }
        .btn-secondary {
            background-color: #666666;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #777777;
        }
        .modal-footer {
            border-top: 1px solid #404040;
        }
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .table-responsive::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        .table-responsive::-webkit-scrollbar-thumb {
            background: #404040;
            border-radius: 4px;
        }
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #4CAF50;
        }
        .search-container {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-grow: 1;
            justify-content: flex-end;
            margin-left: 15px;
        }
        .search-input {
            max-width: 300px;
            background-color: #333333;
            border: 1px solid #404040;
            color: #e0e0e0;
            border-radius: 8px;
            padding: 10px 15px;
            padding-left: 35px;
            position: relative;
        }
        .search-icon {
            position: absolute;
            left: 12px;
            color: #808080;
            pointer-events: none;
        }
        .search-wrapper {
            position: relative;
            display: inline-block;
        }
        .actions-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<!-- HTML structure tetap sama seperti sebelumnya -->
<div class="container main-container">
    <h2 class="page-title">
        <i class="fas fa-users me-2"></i>Data Anggota
    </h2>

    <?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>
        <?= session()->getFlashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?= session()->getFlashdata('errors'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="actions-container">
        <a href="<?= base_url('register') ?>" class="btn btn-custom-add">
            <i class="fas fa-plus-circle me-2"></i>Tambah Anggota
        </a>
        <div class="search-container">
            <div class="search-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Cari anggota...">
            </div>
        </div>
    </div>

    <!-- Sisa HTML sama seperti sebelumnya -->
    <!-- ... -->
    <div class="table-responsive">
        <table class="table table-hover" id="usersTable">
            <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['UserID']; ?></td>
                    <td><?= $user['Username']; ?></td>
                    <td><?= $user['Email']; ?></td>
                    <td><?= $user['NamaLengkap']; ?></td>
                    <td><?= $user['Alamat']; ?></td>
                    <td>
                        <span class="badge bg-<?= $user['role'] === 'admin' ? 'primary' : 'success' ?>">
                            <?= $user['role']; ?>
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-action" data-bs-toggle="modal" data-bs-target="#editModal<?= $user['UserID']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="/admin/users/delete/<?= $user['UserID']; ?>" class="btn btn-danger btn-action" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal<?= $user['UserID']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fas fa-edit me-2"></i>Edit Anggota
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/admin/users/update/<?= $user['UserID']; ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="Username" value="<?= $user['Username']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="Email" value="<?= $user['Email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="NamaLengkap" value="<?= $user['NamaLengkap']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="Alamat" value="<?= $user['Alamat']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" name="role">
                                        <option value="peminjam" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>Peminjam</option>
                                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                           
                                        </select>
                                    </div>
                                    <div class="text-end">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary ms-2">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('usersTable');
    
    searchInput.addEventListener('keyup', function(e) {
        const searchText = e.target.value.toLowerCase();
        const tableRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        Array.from(tableRows).forEach(row => {
            const textContent = row.textContent.toLowerCase();
            const shouldShow = textContent.includes(searchText);
            row.style.display = shouldShow ? '' : 'none';
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
    
</script>
</body>
</html>