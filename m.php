<?php 
//include_once("app/ajax/usuario/gateway.php");
require_once 'r.php';
require_once 'app/config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();

$clave = "1234"; //"Gabriela2011";
echo "Password del usuario....".$clave."<br>";
// Comparo las claves, pero primero descifro la clave 
echo "-------------  NEW  --------------<br>";        
$clave2 = encryptor('encrypt', $clave);
echo "clave cifrada......".$clave2."<br>";
//descifrar clave
$clave3 = encryptor('decrypt', $clave2);
echo "clave descifrada......".$clave3;
echo "<br>";
$interno = rand(10000000,100000123456789);
echo  $interno;

echo "-------------  NEW 2  --------------<br>"; 
$clave2="T2hHdkNUSlhmZUNQakxjTFNBM2xNQT09";
$clave3 = encryptor('decrypt', $clave2);
echo "clave descifrada......".$clave3;
?>