 <?php
 session_start();
?>
<?php
$email; $password; $captcha;

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

if(!$captcha){
    echo 'Verifique el formulario del Captcha.';
    exit;
}

$secretKey = "6Le7QGwbAAAAALdiWDU09MIJmCcPrKG0Sappz2rQ";
$ip = $_SERVER['REMOTE_ADDR'];

// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => $secretKey, 'response' => $captcha, 'remoteip' => $ip);

$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
	)
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$responseKeys = json_decode($response,true);
header('Content-type: application/json');
if($responseKeys["success"]) {	
	include 'app/curl/usuario/buscar.php';
	
	if ($cantidad == 1){
		echo json_encode(array('success' => 'true'));
	}
	else{
		echo json_encode(array('success' => 'midle'));
	}

} else {
	echo json_encode(array('success' => 'false'));
}
?>