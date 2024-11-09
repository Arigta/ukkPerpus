<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6B73FF, #000DFF);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        .btn-primary {
            background: #6B73FF;
            border: none;
        }

        .btn-primary:hover {
            background: #000DFF;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .alert {
            border-radius: 8px;
        }

        .text-center a {
            color: #6B73FF;
            text-decoration: none;
        }

        .text-center a:hover {
            color: #000DFF;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <form action="<?= base_url('/register') ?>" method="post" class="container mt-5" style="max-width: 600px;">
        <?= csrf_field() ?>
        
        <h2 class="text-center mb-4">Daftar</h2>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Daftar</button>
        </div>

        <div class="text-center mt-3">
            <small>Sudah punya akun? <a href="/login" class="text-primary">Masuk di sini</a></small>
        </div>
    </form>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
