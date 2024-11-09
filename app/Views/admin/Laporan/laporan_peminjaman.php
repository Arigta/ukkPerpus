<!-- Views/admin/Laporan/laporan_peminjaman.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #e0f2f1;
            text-align: left;
        }

        h2,
        p {
            text-align: center;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

    </style>
</head>

<body>

    <button class="btn btn-success" onclick="window.print()">Cetak Laporan</button>

    <h2>LAPORAN DATA PEMINJAMAN</h2>
    <p>APLIKASI PERPUSTAKAAN DIGITAL SMK NEGERI 9 MEDAN </p>
    <p>Data Ini merupakan data keseluruhan peminjaman perpustakaan</p>
    <br><br>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th scope="col">ID Peminjam</th>
                <th scope="col">ID User</th>
                <th scope="col">ID Buku</th>
                <th scope="col">Tanggal Peminjaman</th>
                <th scope="col">Tanggal Pengembalian</th>
                <th scope="col">Status Peminjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($peminjaman)) : ?>
                <?php foreach ($peminjaman as $item) : ?>
                    <tr>
                        <td><?= $item['PeminjamanID'] ?></td>
                        <td><?= $item['UserID'] ?></td>
                        <td><?= $item['BukuID'] ?></td>
                        <td><?= $item['TanggalPeminjaman'] ?></td>
                        <td><?= $item['TanggalPengembalian'] ?></td>
                        <td><?= $item['StatusPeminjaman'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Data peminjaman tidak tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature text-start mt-4">
        <p>Mengetahui:</p>
        <p>Kepala Sekolah</p>
        <br><br>
        <p><strong>Bapak Kepala. Sekolah</strong></p>
    </div>

</body>

</html>