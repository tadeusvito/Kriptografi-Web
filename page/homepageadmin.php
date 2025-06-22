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
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Space Grotesk', sans-serif;
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

        h1, h2 {
            color: #0073A8;
            font-weight: bold;
        }

        .btn-danger {
            font-weight: bold;
        }

        .content-container {
            margin-top: 40px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #0073A8;
            color: white;
        }

        .animated-image {
            transition: transform 1s ease;
        }

        .animated-image:hover {
            transform: rotate(360deg);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-white fw-bold" href="homepageadmin.php">Dashboard</a>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="lihatakun.php">Lihat Akun</a>
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
                <!-- Logout Button -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link btn btn-danger text-white" href="../controller/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row align-items-center content-container">
            <div class="col-md-6 text-md-start text-center mb-4 mb-md-0">
                <h1 class="display-4 fw-bold mb-4">
                    Hai, <?php echo htmlspecialchars($username); ?>!
                </h1>
                <h2>
                    Selamat datang di Sistem <br> Pengarsipan Sertifikat
                </h2>
            </div>
            <div class="col-md-6 text-center py-5">
                <img src="../image/pict.png" class="img-fluid animated-image w-75" alt="Sample Image">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
