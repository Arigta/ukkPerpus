<!-- Views/admin/Laporan/laporan_ulasan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Ulasan Buku</title>
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

    <h2>LAPORAN ULASAN BUKU</h2>
    <p>APLIKASI PERPUSTAKAAN DIGITAL SMK NEGERI 9 MEDAN</p>
    <p>Data ini merupakan ulasan buku yang diberikan oleh pengguna perpustakaan</p>
    <br><br>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th scope="col">ID Ulasan</th>
                <th scope="col">ID User</th>
                <th scope="col">ID Buku</th>
                <th scope="col">Ulasan</th>
                <th scope="col">Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ulasan)) : ?>
                <?php foreach ($ulasan as $item) : ?>
                    <tr>
                        <td><?= $item['UlasanID'] ?></td>
                        <td><?= $item['UserID'] ?></td>
                        <td><?= $item['BukuID'] ?></td>
                        <td><?= $item['Ulasan'] ?></td>
                        <td><?= $item['Rating'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">Data ulasan tidak tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="signature text-start mt-4">
        <p>Mengetahui:</p>
        <p>Kepala Sekolah</p>
        <br><br>
        <p><strong>Bapak Kepala Sekolah</strong></p>
    </div>

</body>

</html>
