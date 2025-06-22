<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0073A8, #004a93);
            color: #fff;
            min-height: 100vh;
        }

        .navbar {
            background-color: #004a93;
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

        .form-floating {
            position: relative;
        }

        .form-floating input {
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
        }

        .form-floating label {
            color: #ddd;
        }

        .form-floating input:focus {
            background-color: rgba(255, 255, 255, 0.2);
            outline: none;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(to right, #0073A8, #004a93);
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #004a93, #0073A8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .img-fluid {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background-color: #004a93;
            padding: 20px 0;
            text-align: center;
            color: #fff;
        }

        .footer a {
            color: #ffd700;
            margin: 0 10px;
            font-size: 1.2rem;
        }

        .footer a:hover {
            color: #fff;
        }

        @media (max-width: 768px) {
            .h-custom {
                height: 100%;
            }

            .img-fluid {
                max-width: 80%;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark py-3">
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="../home.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <section class="vh-100">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <!-- Image -->
                <div class="col-lg-6 text-center">
                    <img src="../image/1.png" class="img-fluid" alt="Login Illustration">
                </div>

                <!-- Login Form -->
                <div class="col-lg-5">
                    <div class="card bg-dark text-light p-4 rounded-3">
                        <h2 class="text-center mb-4">Login to Your Account</h2>
                        <form action="../controller/cek_login.php" method="post">
                            <!-- Username -->
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                                <label for="floatingInput">Username</label>
                            </div>
                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <!-- Remember Me -->
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <input type="checkbox" id="rememberMe">
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                                <a href="#!" class="text-warning">Forgot Password?</a>
                            </div>
                            <!-- Login Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <p class="text-center mt-4">
                                Don't have an account? <a href="register.php" class="text-warning">Register</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div>© 2024. All rights reserved.</div>
        <div>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-google"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
