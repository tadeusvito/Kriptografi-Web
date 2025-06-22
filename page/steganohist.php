<?php
session_start();
include "../controller/koneksi.php";

$id = $_SESSION['ID']; // Pastikan ID tersedia dalam sesi

// Ambil gambar dari database
$query = "SELECT id, gambar FROM stegano WHERE id_acc2 = '$id'";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Gagal mengambil data dari database: " . mysqli_error($connect));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Gambar Enkripsi</title>
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

        h2 {
            color: #0073A8;
        }

        .btn-danger {
            font-weight: bold;
        }

        .table th {
            text-transform: uppercase;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="homepageadmin.php">Dashboard</a>
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
                        <a class="nav-link text-white active" href="steganohist.php">Steganografi History</a>
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

    <!-- Main Content -->
    <div class="container my-3">
        <h2 class="mb-4 text-center">Daftar Gambar Enkripsi</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <?php
                            // Decode gambar dari base64
                            $image_data = base64_decode($row['gambar']);
                            $image_path = "../controller/uploads/temp_image_" . $row['id'] . ".png";

                            // Simpan gambar sementara untuk tampilan
                            file_put_contents($image_path, $image_data);
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <img src="<?= $image_path; ?>" alt="Gambar" width="100">
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="<?= $image_path; ?>" download="encrypted_image_<?= $row['id']; ?>.png">Download</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                <p>Tidak ada gambar terenkripsi untuk ditampilkan.</p>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php
mysqli_close($connect);
?>