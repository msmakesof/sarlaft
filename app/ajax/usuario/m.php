<?php  
include("gateway.php");
$key = "V14l1br390MKS-395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8";  //$CON_LlaveAcceso;
    $Password  =  "bVJSMndkekE4Sm9DRUU1alZ3QVBnUT09Ojq aSSdM73XTpO51B MYZIJ";
    $encryption_key_256bit = base64_encode(openssl_random_pseudo_bytes(64));
    $password_decrypted = my_decrypt($Password, $key);			
    $Password2 = $password_decrypted;
    echo "Password2....$Password2";
?>