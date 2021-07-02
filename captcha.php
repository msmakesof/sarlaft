<?php
define("RECAPTCHA_V3_SECRET_KEY", '6Le7QGwbAAAAALdiWDU09MIJmCcPrKG0Sappz2rQ');

$email="";
$password="";
$accede = "S";
//$human="";
if (isset($_POST['email']) && !empty($_POST['email']) ) { 
	$email = strtolower($_POST["email"]);
}
else {
	$accede = "N";
}
if (isset($_POST['password']) && !empty($_POST['password']) ) { 
	$password = trim($_POST["password"]);
}
else {
	$accede = "N";
}


$token = $_POST['token'];
$action = $_POST['action'];
 
// call curl to POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$arrResponse = json_decode($response, true);

if ($accede == "S" && $arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5){
	echo $arrResponse["success"];
	echo $arrResponse["action"];
}
else{
    echo 'Err';
}
?>