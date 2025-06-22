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
    <title>Input Data Sertifikat</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-medium" href="homepageuser.php">Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link text-white active" href="inputdata.php">Input Data</a>
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

    <!-- Form Content -->
    <div class="container mt-5">
        <h2 class="text-center">Input Data Sertifikat</h2>
        <div class="card p-4 mt-4">
            <h4 class="mb-4">Form Input Sertifikat</h4>
            <form action="../controller/cekinput.php" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Certificate's Name</label>
                        <textarea class="form-control" id="name" name="name" placeholder="Enter name" rows="4" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" rows="4" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>