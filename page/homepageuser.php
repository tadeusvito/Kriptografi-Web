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
    <title>Dashboard User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grosteganok', sans-serif;
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

        .container {
            margin-top: 60px;
        }

        .display-4 {
            color: #0073A8;
        }

        h2 {
            font-size: 1.5rem;
            color: #495057;
        }

        .animated-image {
            transition: transform 1s ease;
        }

        .animated-image:hover {
            transform: scale(1.1) rotate(10deg);
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="homepageuser.php">Dashboard</a>
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

    <!-- Content -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-md-start text-center mb-4 mb-md-0">
                <h1 class="display-4 fw-bold">Hai, <?php echo htmlspecialchars($username); ?>!</h1>
                <h2>Selamat datang di Sistem Pengarsipan Sertifikat</h2>
                <p class="mt-3">Gunakan menu di atas untuk mulai mengelola data sertifikat Anda dengan mudah dan aman.</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="../image/2.png" class="img-fluid animated-image w-75" alt="Welcome Image">
            </div>
        </div>
    </div>

    <footer class="mt-5">
        &copy; <?php echo date('Y'); ?> Sistem Pengarsipan Sertifikat. All rights reserved.
    </footer>

    <script>
        document.querySelector('.animated-image').addEventListener('click', function() {
            this.style.transform = 'rotate(360deg)';
            this.style.transition = 'transform 1s';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
