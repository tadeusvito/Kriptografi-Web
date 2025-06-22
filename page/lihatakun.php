<?php
session_start();
include "../controller/koneksi.php";

// Check if the user is logged in, otherwise redirect to login page
if (empty($_SESSION['username'])) {
    header("Location: login.php?pesan=gagal");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - User Accounts</title>
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

        .table th {
            text-transform: uppercase;
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-danger {
            font-weight: bold;
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
                        <a class="nav-link text-white active" href="lihatakun.php">Lihat Akun</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="lihatsertif.php">Sertif Archive</a>
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
    <div class="container my-4">
        <h2 class="text-center mb-4">Daftar Akun Pengguna</h2>

        <div class="table-responsive">
            <?php
            $query = mysqli_query($connect, "SELECT * FROM akun");

            if (mysqli_num_rows($query) > 0): ?>
                <table class="table table-bordered table-striped align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($data['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($data['password']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center mt-3">
                    <p>Tidak ada data akun pengguna.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
