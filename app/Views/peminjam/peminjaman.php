<?= $this->extend('peminjam/layout/peminjam_template'); ?>
<?= $this->section('content'); ?>

<style>
    body {
        background-color: #1a1a1a;
        color: #fff;
    }
    
    .container {
        padding: 2rem;
    }
    
    .page-title {
        color: #fff;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #333;
    }
    
    .alert {
        background-color: rgba(40, 167, 69, 0.2);
        border: 1px solid #28a745;
        color: #28a745;
    }
    
    .table-container {
        background: #2d2d2d;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .table {
        color: #fff;
        background: transparent;
        margin-bottom: 0;
    }
    
    .table thead th {
        background-color: #333;
        color: #fff;
        border-bottom: 2px solid #444;
        padding: 1rem;
        font-weight: 600;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    .table td {
        padding: 1rem;
        border-color: #444;
        vertical-align: middle;
    }
    
    .badge {
        padding: 0.5em 1em;
        font-weight: 500;
        border-radius: 20px;
    }
    
    .badge-warning {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
        border: 1px solid #ffc107;
    }
    
    .badge-success {
        background-color: rgba(40, 167, 69, 0.2);
        color: #28a745;
        border: 1px solid #28a745;
    }
    
    .btn-success {
        background-color: #28a745;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        background-color: #218838;
        box-shadow: 0 0 10px rgba(40, 167, 69, 0.3);
    }
    
    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #888;
        font-style: italic;
    }
    
    /* Custom Scrollbar */
    .table-responsive::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .table-responsive::-webkit-scrollbar-track {
        background: #333;
        border-radius: 4px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb {
        background: #555;
        border-radius: 4px;
    }
    
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #666;
    }
</style>

<div class="container">
    <h2 class="page-title">Daftar Peminjaman Saya</h2>
    
    <?php if(session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    
    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($peminjaman as $p) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $p['Judul']; ?></td>
                        <td><?= date('d/m/Y', strtotime($p['TanggalPeminjaman'])); ?></td>
                        <td><?= $p['TanggalPengembalian'] ? date('d/m/Y', strtotime($p['TanggalPengembalian'])) : '-'; ?></td>
                        <td>
                            <span class="badge badge-<?= $p['StatusPeminjaman'] == 'Dipinjam' ? 'warning' : 'success'; ?>">
                                <?= $p['StatusPeminjaman']; ?>
                            </span>
                        </td>
                        <td>
                            <?php if($p['StatusPeminjaman'] == 'Dipinjam') : ?>
                            <button onclick="confirmReturn('<?= base_url('peminjaman/kembalikan/' . $p['PeminjamanID'] . '/' . $UserID); ?>')" 
                                    class="btn btn-success btn-sm">
                                Kembalikan
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($peminjaman)) : ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="bi bi-inbox me-2"></i>
                            Tidak ada data peminjaman
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmReturn(url) {
    Swal.fire({
        title: 'Konfirmasi Pengembalian',
        text: "Apakah Anda yakin ingin mengembalikan buku ini?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Kembalikan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
<!-- Di bagian head template -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection(); ?>