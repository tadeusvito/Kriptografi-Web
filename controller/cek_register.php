<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Menambahkan pengecekan apakah username dan password tidak kosong
if (empty($username) || empty($password)) {
    header("location:../page/register.php?pesan=kosong");
} else {
    // Mengecek apakah username sudah ada di dalam database
    $checkUsernameQuery = mysqli_query($connect, "SELECT * FROM akun WHERE username='$username'");

    if (mysqli_num_rows($checkUsernameQuery) > 0) {
        // Jika username sudah ada, arahkan kembali ke halaman register.php dengan pesan 'sudahada'
        header("location:../page/register.php?pesan=sudahada");
    } else {
        // Menggunakan hash SHA-256 untuk mengenkripsi password
        $hashedPassword = hash('sha256', $password);

        // Jika username belum ada, tambahkan data ke database dengan password yang telah di-hash
        $query = mysqli_query($connect, "INSERT INTO akun (ID, username, password) VALUES ('', '$username', '$hashedPassword')")
            or die(mysqli_error($connect));

        if ($query) {
            header("location:../page/register.php?pesan=berhasiltambah");
        } else {
            header("location:../page/register.php?pesan=gagal");
        }
    }
}
?>
