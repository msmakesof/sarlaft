<?php
require_once ("app/components/sql_server_login.php");

$query = sqlsrv_query($con,"SELECT CON_IdControl, CON_LlaveAcceso, CON_IdEstado, CON_LlaveInicial, CON_LlaveIv, CON_MetodoEncriptacion,CON_TipoHash, CON_Cookie FROM Control WHERE CON_IdEstado = 1");
if ($query){
    echo "Ok<br>";    
    while($row = sqlsrv_fetch_array($query)){	
        $id=$row['CON_IdControl'];
        $CustomerKey=$row['CON_LlaveAcceso'];
        $secret_key=trim($row['CON_LlaveInicial']);
        $secret_iv=trim($row['CON_LlaveIv']);
        $encrypt_method = trim($row["CON_MetodoEncriptacion"]);
        $tipo_hash = trim($row["CON_TipoHash"]);
    }

    $GLOBALS['tipo_hash'] = $tipo_hash;
    $GLOBALS['secret_key'] = $secret_key;
    $GLOBALS['secret_iv'] = $secret_iv;
    $GLOBALS['encrypt_method'] = $encrypt_method;
    echo $secret_key."<br>";
    echo $secret_iv."<br>";
    echo $encrypt_method."<br>";
    echo $tipo_hash."<br>";

    function encryptor($action, $string) {
        $output = false;
    
        // hash
        $key = hash($GLOBALS['tipo_hash'], $GLOBALS['secret_key']);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
            $iv = substr(hash($GLOBALS['tipo_hash'], $GLOBALS['secret_iv']), 0, 16);		
    
        //do the encyption given text/string/number
            if( $action == 'encrypt' ) 
            {
            $output = openssl_encrypt($string, $GLOBALS['encrypt_method'], $key, 0, $iv);
            $output = base64_encode($output);
        }
            else if( $action == 'decrypt' )
            {
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $GLOBALS['encrypt_method'], $key, 0, $iv);
        }
    
        return trim($output);
    }
}
else {
    echo "Error";
}
?>