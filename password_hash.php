<?php
// $password = 'your_password_here';
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// echo $hashed_password;
// echo "\n";
// $hashed_password = '$2y$10$Hjz1PGKpM3Qkaj/U6i.pSuLd75UxHPSkWX6yhhINPf8xCzdBGa2Aq';
// $entered_password = 'your_password_here';

// if (password_verify($entered_password, $hashed_password)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }



// Encrypt text using AES-256-CBC
function encryptText($plaintext) {
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivSize);
    $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', 'key', OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $ciphertext);
}

// Decrypt text using AES-256-CBC
function decryptText($encryptedText) {
    $data = base64_decode($encryptedText);
    $ivSize = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $ivSize);
    $ciphertext = substr($data, $ivSize);
    return openssl_decrypt($ciphertext, 'aes-256-cbc', 'key', OPENSSL_RAW_DATA, $iv);
}



$plaintext = "Sensitive text to encrypt";
$encrypted = encryptText($plaintext);
echo "Encrypted text: $encrypted\n";

$decrypted = decryptText($encrypted);
echo "Decrypted text: $decrypted\n";
