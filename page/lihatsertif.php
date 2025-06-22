<?php
session_start();
include "../controller/koneksi.php";

// Ensure the user is logged in
if (empty($_SESSION['username'])) {
    header("Location: login.php?pesan=gagal");
    exit();
}

// Query to get encrypted files
$query = mysqli_prepare($connect, "SELECT id_acc, NamaSerti, Deskripsi FROM sertif");
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Encrypted Data</title>
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
                        <a class="nav-link text-white" href="lihatakun.php">Lihat Akun</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white active" href="lihatsertif.php">Sertif Archive</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="lihatstegano.php">Stegano Pict</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="lihatfile.php">File</a>
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
        <h2 class="mb-4 text-center">Encrypted User Input Data</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID Acc</th>
                            <th>Certificate's Name (Encrypted)</th>
                            <th>Description (Encrypted)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <!-- ID Acc column -->
                                <td><?= htmlspecialchars($data['id_acc']) ?></td>

                                <!-- Encrypted Name column -->
                                <td><?= htmlspecialchars(substr($data['NamaSerti'], 0, 50)) ?>...</td>

                                <!-- Encrypted Description column -->
                                <td><?= htmlspecialchars(substr($data['Deskripsi'], 0, 50)) ?>...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                <p>No encrypted data found.</p>
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
mysqli_stmt_close($query);
mysqli_close($connect);
?>
