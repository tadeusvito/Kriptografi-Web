<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            color: #212529;
        }

        .navbar {
            background-color: #0066cc;
        }

        .navbar .nav-link {
            color: white;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .navbar .nav-link:hover {
            color: #ffd700;
        }

        .navbar .nav-link.active {
            color: #ffd700;
        }

        h1 {
            color: #004a93;
            font-weight: 700;
        }

        .btn-primary {
            background-color: #004a93;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 30px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #003366;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .image-container img {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .content-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .lead {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        footer {
            background-color: #004a93;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 30px;
        }

        .animated-image:hover {
            transform: scale(1.05) rotate(10deg);
            transition: transform 0.4s ease-in-out;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3">
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto pt-2 pt-lg-0 font-base">
                    <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link fw-medium active" aria-current="page" href="home.php">Dashboard</a></li>
                    <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="./page/register.php">Register</a></li>
                    <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="./page/login.php">Login </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-5">
        <div class="row align-items-center content-container">
            <div class="col-md-6 col-lg-6 text-container text-md-start text-center mb-4 mb-md-0">
                <h1 class="display-4 fw-bold mb-4">Selamat datang di Dashboard Sistem Pengarsipan Sertifikat</h1>
                <p class="lead mb-4 d-flex text-justify">Di sini, Anda dapat mengelola data sertifikat dengan mudah dan efisien. Dashboard ini menyediakan akses cepat ke berbagai fitur penting, seperti melihat daftar lengkap sertifikat, menambah atau mengedit data sertifikat,
                    serta melihat detail informasi sertifikat secara mendalam. Dengan antarmuka yang intuitif dan ramah pengguna, sistem ini dirancang untuk mempermudah pengelolaan arsip sertifikat dalam organisasi Anda, memastikan bahwa semua informasi selalu terkini dan dapat diakses kapan saja.</p>
                <a class="btn btn-lg btn-primary btn-glow d-flex justify-content-center" href="./page/login.php">Login</a>
            </div>
            <div class="col-md-6 col-lg-6 image-container">
                <img src="image/pict.png" class="img-fluid animated-image w-100" alt="Sample image">
            </div>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Sistem Pengarsipan Sertifikat. All rights reserved.
    </footer>

    <script>
        document.querySelector('.animated-image').addEventListener('click', function () {
            this.style.transform = 'rotate(360deg)';
            this.style.transition = 'transform 1s';
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
