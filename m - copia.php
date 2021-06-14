<?php 
include_once("app/ajax/usuario/gateway.php");
require_once 'app/config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
    $clavecifrada = "SWM4QmgrbHduM2pKaFdtWFdwVTFkdz09Ojr/8b8iZn/XDnOZUwsC8z9i";
    echo "Password del usuario....".$clavecifrada."<br>";
    // Comparo las claves, pero primero descifro la clave 

    $url = $urlServicios."api/control/read.php";
    $query = "";
    $resultado = "";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 0);
    $resultado = curl_exec ($ch);
    curl_close($ch);
    
    $mestado =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $resultado);    
    $dataControl = json_decode($mestado, true);
    $json_errors = array(
        JSON_ERROR_NONE => 'No se ha producido ningún error',
        JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
        JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
        JSON_ERROR_SYNTAX => 'Error de Sintaxis',
    );

    $CON_LlaveAcceso ="";
    if( $dataControl["itemCount"] > 0)
    {
        for($i=0; $i<count($dataControl['body']); $i++)
        {
            $CON_IdControl =          trim($dataControl['body'][$i]['CON_IdControl']);
            $CON_LlaveAcceso = trim($dataControl['body'][$i]['CON_LlaveAcceso']);
            $CON_LlaveInicial=        trim($dataControl['body'][$i]['CON_LlaveInicial']);
            $CON_LlaveIv =            trim($dataControl['body'][$i]['CON_LlaveIv']);
            $CON_MetodoEncriptacion = trim($dataControl['body'][$i]['CON_MetodoEn)criptacion']);
            $CON_TipoHash =           trim($dataControl['body'][$i]['CON_TipoHash']);
            $CON_Cookie =             trim($dataControl['body'][$i]['CON_Cookie']);
        }

        echo "<br>-------------  NEW  --------------<br>";
        $clave = "gala1234<br>";
        $clave = encryptor('encrypt', $clave);
        echo "clave cifrada......".$clave;

        echo "<br>-------------------------------<br>";
        $iv =$CON_LlaveIv;
        include_once ("app/ajax/usuario/gateway.php");
        $key = $CON_LlaveAcceso;
        //echo "passw normal......$passw<br>";
        echo "key......$key<br>";
        echo "iv......$iv<br>";
        echo "Password del usuario....1234<br>";
        $encryption_key_256bit = base64_encode(openssl_random_pseudo_bytes(64));
        //$password_encrypted = my_encrypt($passw, $key);
        $password_decrypted = my_decrypt($clavecifrada, $key);			
        $Password2 = trim($password_decrypted);
        echo "decifra Password2....$Password2<br>";
        //echo "decifra....$password_decrypted<br>";

        echo "<br>-------------------------------<br>";
        /*
            $textToEncrypt = "My super secret information.";
            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
            $secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";

            //To encrypt
            $encryptedMessage = openssl_encrypt($textToEncrypt, $encryptionMethod, $secretHash);

            //To Decrypt
            $decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretHash);

            //Result
            echo "Encrypted: $encryptedMessage <br>Decrypted: $decryptedMessage";
            */

        // Store a string into the variable which
        // need to be Encrypted
        $simple_string = "gala1234";
        
        // Display the original string
        echo "Original String: " . $simple_string."<br>";
        
        // Store the cipher method
        $ciphering = "AES-256-CBC";            //CON_MetodoEncriptacion
        //"AES-128-CTR";
        
        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '395f426c0e5bd914';    //CON_LlaveIv           //375837483b791d80854dd9a19dd86fd189';   
                       //'1234567891011121';
        // Store the encryption key
        $encryption_key = "V14l1br390MKS-395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8"; //CON_LlaveAcceso
        //"GeeksforGeeks";
        
        // Use openssl_encrypt() function to encrypt the data
        $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
        
        // Display the encrypted string
        $encryption = "DhWJan9 SIpzAm6Irf71iA==";
        echo "Encrypted String: " . $encryption . "<br>";
        
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '395f426c0e5bd914';    //CON_LlaveIv        //375837483b791d80854dd9a19dd86fd189';
                       //'1234567891011121';
        

        // Store the decryption key
        $decryption_key = "V14l1br390MKS-395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8"; //CON_LlaveAcceso
        //"GeeksforGeeks";
        
        // Use openssl_decrypt() function to decrypt the data
        $decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
        
        // Display the decrypted string
        echo "Decrypted String: " . $decryption;    
    }
}
?>