<?php
include '../is_logged.php';
	function saltoLinea($str) {
		//return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
		return $str;
	}
	
	require_once '../../config/dbx.php';
	$getUrl = new Database();
	$urlServicios = $getUrl->getUrl();
	
	// escaping, additionally removing everything that could be (html/javascript-) code
	$nombre = $_POST["ActividadEconomicaName2"];
	$ObjetoSocial = $_POST["ObjetoSocial"];
	$DescripcionGeneral = $_POST["DescripcionGeneral"];
	$ObjetivosEstrategicos = $_POST["ObjetivosEstrategicos"];
	$Mision = $_POST["Mision"];
	$Vision = $_POST["Vision"];
	$ck= trim($_SESSION['Keyp']);
	$id=intval($_POST['edit_id']);
	
	$query = "";
	$getConnectionCli2 = new Database();
	$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);
	
	$sql = "UPDATE CLI_InfoBasica SET CLI_ActividadEconomica= '". $nombre ."', CLI_ObjetoSocial='". $ObjetoSocial ."', CLI_DescripcionGeneral= '". $DescripcionGeneral . "', CLI_Mision='". $Mision ."', CLI_Vision= '". $Vision ."', CLI_ObjetivosEstrategicos ='". $ObjetivosEstrategicos . "' WHERE CLI_IdInfoBasica = $id ";
	$query = sqlsrv_query($conn,$sql);
	
	// if CLI_InfoBasica has been updated successfully
	if ($query) {
		$messages[] = "U"; //Update.";
	} else {
		$errors[] = "R"; //Error falla en la conexión.";
	}
		
if (isset($errors)){
	foreach ($errors as $error) {
		$msjx = $error; 
	}
}
if (isset($messages)){	
	foreach ($messages as $message) {
		$msjx =$message; 
	}
}	
echo $msjx;
?>			