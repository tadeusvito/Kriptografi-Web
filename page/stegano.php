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
    <title>Steganografi Gambar</title>
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
                        <a class="nav-link text-white active" href="stegano.php">Steganografi</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="steganohist.php">Steganografi History</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="file.php">File</a>
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
        <h2 class="text-center">Steganografi Gambar (PNG Only)</h2>

        <!-- Pesan -->
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Form Enkripsi -->
        <div class="card p-4 mt-4">
            <h4>Enkripsi (Sisipkan Link Sertifikat)</h4>
            <form action="../controller/cekstegano.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="encrypt">
                <div class="mb-3">
                    <label for="cert_link" class="form-label">Certificate Link</label>
                    <input type="text" class="form-control" id="cert_link" name="cert_link" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image (PNG)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/png" required>
                </div>
                <button type="submit" class="btn btn-primary">Encrypt</button>
            </form>
        </div>

        <!-- Tautan Unduhan -->
        <?php if (isset($_GET['download_link'])): ?>
            <div class="alert alert-success mt-4">
                <p>Gambar telah terenkripsi. Anda dapat mengunduhnya:</p>
                <a href="<?php echo htmlspecialchars($_GET['download_link']); ?>" class="btn btn-success" download onclick="clearPage()">Download Encrypted Image</a>
            </div>
        <?php endif; ?>

        <hr>

        <!-- Form Dekripsi -->
        <div class="card p-4 mt-4">
            <h4>Dekripsi (Ekstrak Link dari Gambar)</h4>
            <form action="../controller/cekstegano.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="decrypt">
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Encrypted Image (PNG)</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/png" required>
                </div>
                <button type="submit" class="btn btn-primary">Extract</button>
            </form>
        </div>

        <!-- Hasil Dekripsi -->
        <?php if (isset($_GET['extracted_text']) && !empty($_GET['extracted_text'])): ?>
            <div class="mt-4 alert alert-success">
                <h5>Extracted Text:</h5>
                <textarea class="form-control" rows="4" readonly><?php echo htmlspecialchars($_GET['extracted_text']); ?></textarea>
                <button class="btn btn-secondary mt-3" onclick="clearPage()">Clear Page</button>
            </div>
        <?php elseif (isset($_GET['extracted_text'])): ?>
            <div class="mt-4 alert alert-danger">
                <h5>Extracted Text:</h5>
                <p>Teks tidak ditemukan dalam gambar.</p>
                <button class="btn btn-secondary mt-3" onclick="clearPage()">Clear Page</button>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script>
        // Fungsi untuk clear halaman setelah aksi
        function clearPage() {
            setTimeout(() => {
                window.location.href = window.location.pathname;
            }, 500); // Tunggu 500ms sebelum reload
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>