<?php
include "../controller/koneksi.php";

// Dapatkan ID dari parameter query
$id = $_GET['id'] ?? null;

if ($id) {
    // Validasi ID file
    if (!ctype_digit($id)) {
        die("Invalid file ID format.");
    }

    // Query untuk mendapatkan data file berdasarkan ID file
    $query = "SELECT file FROM files WHERE ID = ?";
    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        error_log("Failed to prepare statement: " . $connect->error);
        die("Failed to prepare the statement.");
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($file_data);
    $stmt->fetch();
    $stmt->close();

    if ($file_data) {
        $decoded_file = base64_decode($file_data); // Decode file dari format base64
        if ($decoded_file === false) {
            die("Failed to decode file data.");
        }

        // Kirim file ke browser untuk diunduh
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="encrypted_file_' . $id . '.des"');
        header('Content-Length: ' . strlen($decoded_file));
        echo $decoded_file;
        exit();
    } else {
        die("File not found for the given ID.");
    }
} else {
    die("Invalid request. Missing file ID.");
}
?>
