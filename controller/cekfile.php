<?php
session_start();
include "../controller/koneksi.php";

// Fungsi untuk mengenkripsi file menggunakan DES
function encrypt_file($file_path, $key, $output_path)
{
    $data = file_get_contents($file_path);
    $method = 'DES-EDE3'; // Algoritma Triple DES
    $encrypted_data = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA);
    file_put_contents($output_path, $encrypted_data);
    return "File berhasil dienkripsi!";
}

// Fungsi untuk mendekripsi file menggunakan DES
function decrypt_file($file_path, $key, $output_path)
{
    $data = file_get_contents($file_path);
    $method = 'DES-EDE3'; // Algoritma Triple DES
    $decrypted_data = openssl_decrypt($data, $method, $key, OPENSSL_RAW_DATA);
    file_put_contents($output_path, $decrypted_data);
    return "File berhasil didekripsi!";
}

// Generate kunci DES secara otomatis
function generate_des_key($length = 24)
{
    return substr(bin2hex(random_bytes($length / 2)), 0, $length);
}

// Proses berdasarkan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses enkripsi
    if (isset($_POST['action']) && $_POST['action'] === 'encrypt') {
        if (isset($_FILES['file'])) {
            $uploaded_file = $_FILES['file']['tmp_name'];
            $generated_key = generate_des_key(); // Generate kunci DES secara otomatis
            $output_path = '../controller/uploads/encrypted_file_' . uniqid() . '.des';

            // Pastikan direktori uploads ada
            if (!is_dir('../controller/uploads')) {
                mkdir('../controller/uploads', 0777, true);
            }

            if (move_uploaded_file($uploaded_file, 'temp_uploaded_file')) {
                $message = encrypt_file('temp_uploaded_file', $generated_key, $output_path);

                if ($message === "File berhasil dienkripsi!") {
                    // Simpan data ke database
                    $file_data = file_get_contents($output_path); // Baca isi file hasil enkripsi
                    $base64_file = base64_encode($file_data); // Encode file menjadi base64
                    $id = $_SESSION['ID']; // Pastikan ID tersedia dalam sesi

                    $query = "INSERT INTO files (id_acc3, file, kunci) VALUES ('$id', '$base64_file', '$generated_key')";
                    if (mysqli_query($connect, $query)) {
                        // Redirect ke halaman dengan pesan dan tautan unduhan
                        header("Location: ../page/file.php?message=File+berhasil+disimpan+ke+database&download_link=$output_path&key=$generated_key");
                        exit();
                    } else {
                        die("Gagal menyimpan ke database: " . mysqli_error($connect));
                    }
                } else {
                    header("Location: ../page/file.php?message=Proses+enkripsi+gagal");
                    exit();
                }
            } else {
                header("Location: ../page/file.php?message=Gagal+mengunggah+file");
                exit();
            }
        }
    }

    // Proses dekripsi
    if (isset($_POST['action']) && $_POST['action'] === 'decrypt') {
        if (isset($_FILES['file']) && isset($_POST['key'])) {
            $uploaded_file = $_FILES['file']['tmp_name'];
            $key = $_POST['key'];
            $output_path = '../controller/uploads/decrypted_file_' . uniqid();

            if (move_uploaded_file($uploaded_file, 'uploaded_encrypted_file')) {
                $message = decrypt_file('uploaded_encrypted_file', $key, $output_path);

                // Redirect ke halaman dengan pesan dan tautan unduhan
                header("Location: ../page/file.php?message=" . urlencode($message) . "&decrypted_message=success&download_link=" . urlencode($output_path));
                exit();
            } else {
                header("Location: ../page/file.php?message=Gagal+mengunggah+file");
                exit();
            }
        }
    }
}
?>
