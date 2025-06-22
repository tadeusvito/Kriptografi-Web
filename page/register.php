<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0073A8, #004a93, #001f3f);
            color: #ffffff;
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

        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            backdrop-filter: blur(10px);
            color: #fff;
            border-radius: 15px;
        }

        .card h2 {
            color: #ffd700;
        }

        .form-label {
            color: #ffffff;
        }

        .btn-info {
            background: linear-gradient(90deg, #004a93, #0073A8);
            color: white;
            font-weight: bold;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-info:hover {
            background: linear-gradient(90deg, #0073A8, #004a93);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .gradient-custom-4 {
            background: linear-gradient(to right, #0066cc, #004080);
        }

        .form-check-label a {
            color: #ffd700;
        }

        .form-check-label a:hover {
            text-decoration: underline;
        }

        .text-light a {
            color: #ffd700;
        }

        .text-light a:hover {
            text-decoration: underline;
        }

        .alert {
            font-size: 0.9rem;
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
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
                    <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" aria-current="page" href="../home.php">Dashboard</a></li>
                    <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link fw-medium active" href="employeelistpage.php">Register</a></li>
                    <li class="nav-item px-2" data-anchor="data-anchor"><a class="nav-link" href="login.php">Login </a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="mask d-flex align-items-center h-100 gradient-custom-3 mt-4" style="padding-top: 50px;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                            <?php
                            if (isset($_GET['pesan'])) {
                                if ($_GET['pesan'] == "kosong") {
                                    echo "<div class='alert alert-primary' role='alert'>
                                        *Silahkan isi form dengan benar
                                    </div>";
                                } else if ($_GET['pesan'] == "berhasiltambah") {
                                    echo "<div class='alert alert-success' role='alert'>
                                        *Berhasil Membuat Akun
                                    </div>";
                                } else if ($_GET['pesan'] == "sudahada") {
                                    echo "<div class='alert alert-info' role='alert'>
                                            *Username yang Anda buat sudah ada, silakan ganti.
                                        </div>";
                                }
                            }
                            ?>
                            <form action="../controller/cek_register.php" method="POST" onsubmit="return validateForm()">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Your Username</label>
                                    <input type="text" name="username" id="form3Example3cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4cg">Create Password</label>
                                    <input type="password" name="password" id="form3Example4cg" class="form-control form-control-lg" />
                                </div>

                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                                    <label class="form-check-label" for="form2Example3g">
                                        I agree all statements in <a href="#!" class="text-body"><u class="text-light">Terms of service</u></a>
                                    </label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <input type="submit" value="Register" class="btn btn-info btn-block btn-lg gradient-custom-4 text-body">
                                </div>

                                <p class="text-center text-light mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold" style="color: #ffd700;"><u>Login here</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
