<?php
session_start();
include "../controller/koneksi.php";

if (empty($_SESSION['username'])) {
    header("Location: login.php?pesan=gagal");
    exit();
}

$id = $_SESSION['ID'];

// Caesar decryption function
function caesar_decrypt($data, $shift)
{
    $output = '';
    $shift = $shift % 26;
    for ($i = 0; $i < strlen($data); $i++) {
        $char = $data[$i];
        if (ctype_alpha($char)) {
            $ascii_offset = ctype_upper($char) ? 65 : 97;
            $output .= chr((ord($char) - $ascii_offset - $shift + 26) % 26 + $ascii_offset);
        } else {
            $output .= $char;
        }
    }
    return $output;
}

// AES decryption function
function aes_decrypt($input, $key)
{
    $method = 'AES-256-CBC';

    $data = base64_decode($input);
    if ($data === false) {
        echo "Error: Base64 decoding failed.<br>";
        return false;
    }

    $iv_length = openssl_cipher_iv_length($method);
    if (strlen($data) < $iv_length) {
        echo "Error: Data length is too short.<br>";
        return false;
    }

    $iv = substr($data, 0, $iv_length);
    $encrypted_data = substr($data, $iv_length);

    $decrypted = openssl_decrypt($encrypted_data, $method, $key, OPENSSL_RAW_DATA, $iv);
    if ($decrypted === false) {
        echo "Decryption failed: " . openssl_error_string() . "<br>";
    }
    return $decrypted;
}

$caesar_shift = 8;

$query = mysqli_prepare($connect, "SELECT NamaSerti, Deskripsi, iv_length FROM sertif WHERE id_acc = ?");
mysqli_stmt_bind_param($query, "i", $id);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Encrypted Data</title>
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

        .btn-info {
            background-color: #0073A8;
            border-color: #0073A8;
        }

        .btn-info:hover {
            background-color: #005f8a;
            border-color: #005f8a;
        }

        .alert {
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
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
    <script>
        function togglePlaintext(id) {
            var plaintext = document.getElementById(id);
            if (plaintext.style.display === "none") {
                plaintext.style.display = "block";
            } else {
                plaintext.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-medium" href="homepageuser.php">Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-2">
                        <a class="nav-link text-white" href="inputdata.php">Input Data</a>
                    </li>
                    <li class="nav-item px-2">
                        <a class="nav-link text-white active" href="hasilinput.php">Lihat Data</a>
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

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center">Encrypted Data</h2>
        <div class="card p-4 mt-4">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="text-center" style="background-color: #0073A8; color: white;">
                        <tr>
                            <th style="width: 25%;">Certificate's Name (Ciphertext)</th>
                            <th style="width: 25%;">Description (Ciphertext)</th>
                            <th style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                            <?php
                            $aes_key = 'e9c8a9f4d15b6d8f9a4b3e2a1d6c6b4e';

                            // Decrypt the name and description with Caesar cipher
                            $decrypted_name_caesar = caesar_decrypt($data['NamaSerti'], $caesar_shift);
                            $decrypted_description_caesar = caesar_decrypt($data['Deskripsi'], $caesar_shift);

                            // Decrypt the name and description with AES
                            $original_name = aes_decrypt($decrypted_name_caesar, $aes_key);
                            $original_description = aes_decrypt($decrypted_description_caesar, $aes_key);
                            ?>
                            <tr>
                                <td>
                                    <span id="ciphertext_name_<?= $data['iv_length'] ?>" class="fw-bold text-secondary">
                                        <?= htmlspecialchars(substr($data['NamaSerti'], 0, 50)) ?>... <!-- Batasi hanya 50 karakter -->
                                    </span>
                                    <div id="plaintext_name_<?= $data['iv_length'] ?>" class="mt-2 p-2 bg-light border rounded" style="display: none;">
                                        <?= htmlspecialchars($original_name) ?>
                                    </div>
                                </td>
                                <td>
                                    <span id="ciphertext_description_<?= $data['iv_length'] ?>" class="fw-bold text-secondary">
                                        <?= htmlspecialchars(substr($data['Deskripsi'], 0, 50)) ?>... <!-- Batasi hanya 50 karakter -->
                                    </span>
                                    <div id="plaintext_description_<?= $data['iv_length'] ?>" class="mt-2 p-2 bg-light border rounded" style="display: none;">
                                        <?= htmlspecialchars($original_description) ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-info mb-2" onclick="togglePlaintext('plaintext_name_<?= $data['iv_length'] ?>')">Name's Plaintext</button>
                                    <button class="btn btn-info" onclick="togglePlaintext('plaintext_description_<?= $data['iv_length'] ?>')">Description's Plaintext</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    <p>No encrypted data found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Cryptography System. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
<?php
mysqli_stmt_close($query);
mysqli_close($connect);
?>