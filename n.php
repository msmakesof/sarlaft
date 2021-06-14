<?php 
//class Openssl_EncryptDecrypt {
    function encrypt ($pure_string, $encryption_key) {
        $cipher     = 'AES-256-CBC';
        $options    = OPENSSL_RAW_DATA;
        $hash_algo  = 'sha256';
        $sha2len    = 32;
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($pure_string, $cipher, $encryption_key, $options, $iv);
        $hmac = hash_hmac($hash_algo, $ciphertext_raw, $encryption_key, true);
        return $iv.$hmac.$ciphertext_raw;
    }
    function decrypt ($encrypted_string, $encryption_key) {
        $cipher     = 'AES-256-CBC';
        $options    = OPENSSL_RAW_DATA;
        $hash_algo  = 'sha256';
        $sha2len    = 32;
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($encrypted_string, 0, $ivlen);
        $hmac = substr($encrypted_string, $ivlen, $sha2len);
        $ciphertext_raw = substr($encrypted_string, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $encryption_key, $options, $iv);
        $calcmac = hash_hmac($hash_algo, $ciphertext_raw, $encryption_key, true);
        if(function_exists('hash_equals')) {
            if (hash_equals($hmac, $calcmac)) return $original_plaintext;
        } else {
            if ($this->hash_equals_custom($hmac, $calcmac)) return $original_plaintext;
        }
    }
    /**
     * (Optional)
     * hash_equals() function polyfilling.
     * PHP 5.6+ timing attack safe comparison
     */
    function hash_equals_custom($knownString, $userString) {
        if (function_exists('mb_strlen')) {
            $kLen = mb_strlen($knownString, '8bit');
            $uLen = mb_strlen($userString, '8bit');
        } else {
            $kLen = strlen($knownString);
            $uLen = strlen($userString);
        }
        if ($kLen !== $uLen) {
            return false;
        }
        $result = 0;
        for ($i = 0; $i < $kLen; $i++) {
            $result |= (ord($knownString[$i]) ^ ord($userString[$i]));
        }
        return 0 === $result;
    }
//}

define('ENCRYPTION_KEY', '__^%&Q@$&*!@#$%^&*^__');
$string = "This is the original string!";
echo $string."<br>";

$c1 = encrypt($string, ENCRYPTION_KEY);
echo "cifrado......$c1<br>";

$c1 = decrypt($c1, ENCRYPTION_KEY);
echo "descifrado......$c1<br>";

echo "-----------------------------------------------------<br>";
$c2 = "���D�v.$���bRh/G1�O�GXL�K+�n/>��G�Qc�O1����)ͮ5�4Tп�`~Q��Io�U�;�";
$cr = decrypt($c2, ENCRYPTION_KEY);
echo "descifrado......$cr<br>";

echo "-----------------------------------------------------<br>";
// forma 2:
    $options = [
        'cost' => 11
     ];
     $hash = password_hash('rasmuslerdorf', PASSWORD_BCRYPT, $options);
echo "$hash<br>";


// para descifrar
if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

echo "-----------------------------------------------------<br>";

$algorithm = MCRYPT_BLOWFISH;
$key = 'That golden key that opens the palace of eternity.';
$data = 'The chicken escapes at dawn. Send help with Mr. Blue.';
$mode = MCRYPT_MODE_CBC;

$iv = mcrypt_create_iv(mcrypt_get_iv_size($algorithm, $mode), MCRYPT_DEV_URANDOM);

$encrypted_data = mcrypt_encrypt($algorithm, $key, $data, $mode, $iv);
$plain_text = base64_encode($encrypted_data);
echo $plain_text . "\n";

$encrypted_data = base64_decode($plain_text);
$decoded = mcrypt_decrypt($algorithm, $key, $encrypted_data, $mode, $iv);
echo $decoded . "\n";



//$OpensslEncryption = new Openssl_EncryptDecrypt;
//$encrypted = $OpensslEncryption->encrypt($string, ENCRYPTION_KEY);
//$decrypted = $OpensslEncryption->decrypt($encrypted, ENCRYPTION_KEY);
?>