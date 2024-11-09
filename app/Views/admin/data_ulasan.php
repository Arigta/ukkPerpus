<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ulasan Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="mb-4">Data Ulasan Buku</h1>

        <!-- Tabel Data Ulasan -->
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Ulasan ID</th>
                    <th>User ID</th>
                    <th>Buku ID</th>
                    <th>Ulasan</th>
                    <th>Rating</th>
  
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ulasan)): ?>
                    <?php foreach ($ulasan as $item): ?>
                        <tr>
                            <td><?= $item['UlasanID']; ?></td>
                            <td><?= $item['UserID']; ?></td>
                            <td><?= $item['BukuID']; ?></td>
                            <td><?= $item['Ulasan']; ?></td>
                            <td><?= $item['Rating']; ?></td>
                           
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada ulasan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
