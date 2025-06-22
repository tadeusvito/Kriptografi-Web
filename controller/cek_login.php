<?php
session_start();
// Menghubungkan dengan koneksi database
$query = new mysqli('localhost', 'root', '', 'kriptografi');

// Menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Enkripsi password yang dimasukkan dengan SHA-256
$hashedPassword = hash('sha256', $password);

// Menyeleksi data akun dengan username dan password yang sesuai
$data = mysqli_query($query, "SELECT * FROM akun WHERE username='$username' AND password='$hashedPassword'") or die(mysqli_error($query));

// Menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $row = mysqli_fetch_assoc($data);
    // Menyimpan sesi login
    $_SESSION['username'] = $username;
    $_SESSION['ID'] = $row['ID'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['status'] = "login";

    // Mengecek apakah username adalah "admin"
    if ($username === 'admin') {
        // Jika username adalah admin, redirect ke halaman adminpage.php
        header("location:../page/homepageadmin.php?pesan=berhasil");
    } else {
        // Jika bukan admin, redirect ke halaman page.php
        header("location:../page/homepageuser.php?pesan=berhasil");
    }
} else {
    // Jika login gagal, redirect ke login.php dengan pesan gagal
    header("location:../page/login.php?pesan=gagal");
}
?>
