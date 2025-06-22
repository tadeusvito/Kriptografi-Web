<?php
session_start();
if (empty($_SESSION['username'])) {
    header("location:login.php?pesan=gagal");
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Encryption & Decryption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #0073A8;
        }

        .navbar a.nav-link {
            color: white;
            font-weight: bold;
        }

        .navbar a.nav-link.active {
            text-decoration: underline;
        }

        h2,
        h4 {
            color: #0073A8;
        }

        .btn-primary {
            background-color: #0073A8;
            border-color: #0073A8;
        }

        .btn-primary:hover {
            background-color: #005f8a;
            border-color: #005f8a;
        }

        .alert {
            margin-top: 20px;
        }

        .card {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-medium" href="homepageuser.php">Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="inputdata.php">Input Data</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="hasilinput.php">Lihat Data</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="stegano.php">Steganografi</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="steganohist.php">Steganografi History</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white active" href="file.php">File</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="filehistory.php">File Hist</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link btn btn-danger text-white" href="../controller/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">File Encryption & Decryption</h2>

        <!-- Pesan -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Kunci Enkripsi -->
        <?php if (isset($_GET['key'])): ?>
            <div class="alert alert-success">
                <strong>Kunci Enkripsi:</strong>
                <textarea class="form-control mt-2" readonly><?php echo htmlspecialchars($_GET['key']); ?></textarea>
            </div>
        <?php endif; ?>

        <!-- Form Enkripsi -->
        <div class="card p-4 mt-4">
            <h4>Enkripsi File</h4>
            <form action="../controller/cekfile.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="encrypt">
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Encrypt</button>
            </form>
        </div>

        <!-- Tautan Unduhan -->
        <?php if (isset($_GET['download_link'])): ?>
            <div class="alert alert-success mt-4">
                <p>File berhasil diproses. Unduh file Anda:</p>
                <a href="<?php echo htmlspecialchars($_GET['download_link']); ?>" class="btn btn-success" download>Download File</a>
                <button class="btn btn-secondary" onclick="clearPage()">Clear Page</button>
            </div>
        <?php endif; ?>

        <hr>

        <!-- Form Dekripsi -->
        <div class="card p-4 mt-4">
            <h4>Dekripsi File</h4>
            <form action="../controller/cekfile.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="decrypt">
                <div class="mb-3">
                    <label for="file" class="form-label">Upload Encrypted File</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <div class="mb-3">
                    <label for="key" class="form-label">Kunci Enkripsi</label>
                    <input type="text" class="form-control" id="key" name="key" required>
                </div>
                <button type="submit" class="btn btn-primary">Decrypt</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script>
        // Fungsi untuk clear halaman setelah aksi selesai
        function clearPage() {
            setTimeout(() => {
                window.location.href = window.location.pathname;
            }, 500); // Tunggu 500ms sebelum halaman di-refresh
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>