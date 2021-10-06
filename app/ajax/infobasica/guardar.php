<?php
include '../is_logged.php';
//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	if (empty($_POST['ActividadEconomicaName2'])){
		$errors[] = "Ingresa el nombre del Información Básica.";
	} 
	elseif (!empty($_POST['ActividadEconomicaName2']))
	{
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
		$CustomerKey = $_SESSION['Keyp'];

		// Si todo va bien se hace el Insert
		$UserKey = $_SESSION['UserKey'];
		date_default_timezone_set("America/Bogota");
		$InfoBasicaKey = time();
		$DateStamp = date("Y-m-d H:i:s");

		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($_SESSION['Keyp']);

		$sql="INSERT INTO CLI_InfoBasica (CLI_ActividadEconomica, CLI_ObjetoSocial, CLI_DescripcionGeneral, CLI_Mision, CLI_Vision, CLI_ObjetivosEstrategicos, CLI_CustomerKey, CLI_InfoBasicaKey, CLI_USerKey, CLI_DateStamp) VALUES ('".$nombre."','".$ObjetoSocial."','".$DescripcionGeneral."','".$Mision."','".$Vision."','".$ObjetivosEstrategicos."','".$CustomerKey."','".$UserKey."','".$InfoBasicaKey."','".$DateStamp."')";
		$query = sqlsrv_query($conn,$sql);
		//echo $sql;
		// if InfoBasica has been added successfully
		if ($query) {
			$messages[] = "O";
		} else {
			$errors[] = 'R';
		}
	} 
	else 
	{
		$errors[] = "D";
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