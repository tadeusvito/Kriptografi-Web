<?php
session_start();
include "koneksi.php";

$id = $_SESSION['ID'];
if (isset($_POST['name']) && isset($_POST['description'])){
    $name = $_POST['name'];
    $description = $_POST['description'];

    $global_iv = '';

    function aes_encrypt($data, $key) {
        global $global_iv;
        $method = 'AES-256-CBC';
        $iv_length = openssl_cipher_iv_length($method);
        $global_iv = openssl_random_pseudo_bytes($iv_length);
    
        // Encrypt with OPENSSL_RAW_DATA to avoid base64 encoding at this stage
        $encrypted_data = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $global_iv);
    
        if ($encrypted_data === false) {
            echo "Encryption failed: " . openssl_error_string() . "<br>";
            return false;
        }
    
        // Concatenate IV and encrypted data before base64 encoding
        return base64_encode($global_iv . $encrypted_data);
    }    
    
    function caesar_encrypt($data, $shift) {
        $output = '';
        $shift = $shift % 26;
        for ($i = 0; $i < strlen($data); $i++) {
            $char = $data[$i];
            if (ctype_alpha($char)) {
                $ascii_offset = ctype_upper($char) ? 65 : 97;
                $output .= chr((ord($char) - $ascii_offset + $shift) % 26 + $ascii_offset);
            } else {
                $output .= $char;
            }
        }
        return $output;
    }    

    $aes_key = 'e9c8a9f4d15b6d8f9a4b3e2a1d6c6b4e';

    $aes_encrypted_name = aes_encrypt($name, $aes_key);
    $aes_encrypted_description = aes_encrypt($description, $aes_key);
    $global_iv_hex = bin2hex($global_iv);
    echo $global_iv_hex;

    $caesar_shift = 8;
    $super_encrypted_name = caesar_encrypt($aes_encrypted_name, $caesar_shift);
    $super_encrypted_description = caesar_encrypt($aes_encrypted_description, $caesar_shift);

    // simpan iv_length di database
    $query = mysqli_query($connect, "INSERT INTO sertif VALUES ('', '$id', '$super_encrypted_name', '$super_encrypted_description', '$global_iv_hex')") or die(mysqli_error($connect));
    header("Location: ../page/hasilinput.php");
} else {
    echo "Error: Form tidak lengkap.";
}
?>
