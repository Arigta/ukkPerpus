<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40;
            color: #f8f9fa;
        }
        .table-dark {
            background-color: #212529;
        }
        .form-control {
            background-color: #495057;
            color: #a0a0a0; 
            
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Peminjaman</h2>
        <div class="row mb-3">
            <div class="col-md-4 ms-auto">
                <input type="text" class="form-control" id="search" placeholder="Cari ID User">
            </div>
        </div>
        <table class="table table-dark table-hover" id="peminjamanTable">
            <thead>
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">BukuID</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                    <th scope="col">Status Peminjaman</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php if (!empty($peminjaman)) : ?>
                    <?php foreach ($peminjaman as $index => $item) : ?>
                        <tr data-userid="<?= $item['UserID'] ?>">
                            <td><?= $item['UserID'] ?></td>
                            <td><?= $item['BukuID'] ?></td>
                            <td><?= $item['TanggalPeminjaman'] ?></td>
                            <td><?= $item['TanggalPengembalian'] ?></td>
                            <td><?= $item['StatusPeminjaman'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Data peminjaman tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script for Search Functionality -->
    <script>
    document.getElementById('search').addEventListener('keyup', function() {
        let searchValue = this.value.toLowerCase().trim();
        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            // Ambil data UserID dari atribut data-userid
            let userID = row.getAttribute('data-userid').toLowerCase();

            // Menampilkan baris hanya jika UserID cocok dengan nilai pencarian
            row.style.display = userID.includes(searchValue) ? '' : 'none';
        });
    });
    </script>

</body>
</html>
