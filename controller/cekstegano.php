<?php
session_start();
include "../controller/koneksi.php";

$id = $_SESSION['ID']; // Pastikan ID tersedia dalam sesi

// Fungsi untuk menyisipkan teks ke dalam gambar (enkripsi)
function embed_text_in_image($image_path, $text, $output_path)
{
    $image = imagecreatefrompng($image_path);
    if (!$image) {
        return "Gagal membuka gambar!";
    }

    $binary_text = '';
    foreach (str_split($text) as $char) {
        $binary_text .= sprintf("%08b", ord($char));
    }
    $binary_text .= '00000000'; // Null terminator

    $x = $y = 0;
    $width = imagesx($image);
    $height = imagesy($image);

    for ($i = 0; $i < strlen($binary_text); $i++) {
        $rgb = imagecolorat($image, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        $b = ($b & 0xFE) | $binary_text[$i];

        $new_color = imagecolorallocate($image, $r, $g, $b);
        imagesetpixel($image, $x, $y, $new_color);

        $x++;
        if ($x >= $width) {
            $x = 0;
            $y++;
        }

        if ($y >= $height) {
            return "Teks terlalu panjang untuk gambar!";
        }
    }

    imagepng($image, $output_path);
    imagedestroy($image);

    return "Teks berhasil disisipkan ke dalam gambar!";
}

// Fungsi untuk mengekstrak teks dari gambar (dekripsi)
function extract_text_from_image($image_path)
{
    $image = imagecreatefrompng($image_path);
    if (!$image) {
        return "Gagal membuka gambar!";
    }

    $x = $y = 0;
    $width = imagesx($image);
    $height = imagesy($image);

    $binary_text = '';
    while (true) {
        $rgb = imagecolorat($image, $x, $y);
        $b = $rgb & 0xFF; // Ambil nilai biru

        $binary_text .= $b & 1; // Ambil bit paling tidak signifikan (LSB)

        if (strlen($binary_text) % 8 == 0) {
            $char = chr(bindec(substr($binary_text, -8)));
            if ($char === "\0") {
                break;
            }
        }

        $x++;
        if ($x >= $width) {
            $x = 0;
            $y++;
        }

        if ($y >= $height) {
            return "Teks tidak ditemukan dalam gambar!";
        }
    }

    $text = '';
    for ($i = 0; $i < strlen($binary_text) - 8; $i += 8) {
        $text .= chr(bindec(substr($binary_text, $i, 8)));
    }

    return $text;
}

// Logika Proses
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'encrypt') {
        if (isset($_POST['cert_link']) && isset($_FILES['image'])) {
            $cert_link = $_POST['cert_link'];
            $uploaded_image = $_FILES['image']['tmp_name'];

            // Output path untuk download
            $output_path_download = '../controller/downloads/output_image_' . uniqid() . '.png'; // File untuk unduhan

            // Output path untuk database
            $output_path_db = '../controller/uploads/db_image_' . uniqid() . '.png'; // File untuk database

            // Pastikan direktori untuk upload dan download ada
            if (!is_dir('downloads')) {
                mkdir('downloads', 0777, true);
            }
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($uploaded_image, 'temp_uploaded_image.png')) {
                // Proses enkripsi untuk file unduhan
                $message = embed_text_in_image('temp_uploaded_image.png', $cert_link, $output_path_download);

                if ($message === "Teks berhasil disisipkan ke dalam gambar!") {
                    // Salin file ke lokasi untuk database
                    copy($output_path_download, $output_path_db);

                    // Simpan file untuk database
                    $image_data = file_get_contents($output_path_db);
                    $base64_image = base64_encode($image_data);

                    // Masukkan ke database
                    $query = "INSERT INTO stegano (gambar, id_acc2) VALUES ('$base64_image', '$id')";
                    if (mysqli_query($connect, $query)) {
                        // Berikan tautan unduhan
                        header("Location:../page/stegano.php?message=Gambar+berhasil+disimpan+ke+database&download_link=$output_path_download");
                        exit();
                    } else {
                        die("Gagal menyimpan ke database: " . mysqli_error($connect));
                    }
                } else {
                    header("Location: ../page/stegano.php?message=Proses+enkripsi+gagal");
                    exit();
                }
            } else {
                header("Location: ../page/stegano.php?message=Gagal+mengunggah+gambar");
                exit();
            }
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'decrypt') {
        if (isset($_FILES['image'])) {
            $uploaded_image = $_FILES['image']['tmp_name'];

            if (move_uploaded_file($uploaded_image, 'uploaded_image_for_decrypt.png')) {
                $extracted_text = extract_text_from_image('uploaded_image_for_decrypt.png');
                header("Location: ../page/stegano.php?extracted_text=" . urlencode($extracted_text));
                exit();
            } else {
                header("Location: ../page/stegano.php?message=Gagal+mengunggah+gambar");
                exit();
            }
        }
    }
}
