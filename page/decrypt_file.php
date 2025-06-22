<?php
session_start();
include "../controller/koneksi.php";

// Fungsi untuk mendekripsi file menggunakan DES
function decrypt_file($file_path, $key, $output_path)
{
    $data = file_get_contents($file_path); // Baca isi file terenkripsi
    $method = 'DES-EDE3'; // Algoritma Triple DES
    $decrypted_data = openssl_decrypt($data, $method, $key, OPENSSL_RAW_DATA); // Proses dekripsi

    if ($decrypted_data === false) {
        return "Decryption failed. Invalid key or corrupted data."; // Pesan kesalahan
    }

    file_put_contents($output_path, $decrypted_data); // Simpan hasil dekripsi ke file
    return "File successfully decrypted!"; // Pesan sukses
}

// Proses Dekripsi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'decrypt') {
        if (isset($_FILES['file']) && isset($_POST['key'])) {
            $uploaded_file = $_FILES['file']['tmp_name'];
            $key = $_POST['key'];
            $output_path = '../controller/uploads/decrypted_file_' . uniqid() . '.txt'; // Pastikan file memiliki ekstensi

            // Pastikan direktori untuk menyimpan file hasil dekripsi ada
            if (!is_dir('../controller/uploads')) {
                mkdir('../controller/uploads', 0777, true);
            }

            if (move_uploaded_file($uploaded_file, 'uploaded_encrypted_file')) {
                // Lakukan proses dekripsi
                $message = decrypt_file('uploaded_encrypted_file', $key, $output_path);

                if (strpos($message, "successfully decrypted") !== false) {
                    // Redirect ke halaman dengan tautan unduhan file hasil dekripsi
                    header("Location: filehistory.php?message=" . urlencode($message) . "&download_link=" . urlencode($output_path));
                    exit();
                } else {
                    // Dekripsi gagal
                    header("Location: filehistory.php?message=" . urlencode($message));
                    exit();
                }
            } else {
                // Gagal mengunggah file
                header("Location: filehistory.php?message=Failed+to+upload+file.");
                exit();
            }
        } else {
            // Permintaan tidak valid
            header("Location: filehistory.php?message=Invalid+request.");
            exit();
        }
    }
}
?>
