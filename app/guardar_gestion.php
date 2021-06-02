<?php include 'ajax/is_logged.php';?>
<?php require_once 'components/sql_server.php';?>
<?php
if ($_POST['ConsecutivoEventoRiesgoValue']==NULL||
	$_POST['EventosdeRiesgoName']==NULL||
	$_POST['ProcesosName']==NULL||
	$_POST['CargosName']==NULL||
	$_POST['ResponsablesName']==NULL||
	$_POST['TipoRiesgo']==NULL||
	$_POST['FuenteRiesgoA']==NULL||
	$_POST['FuenteRiesgoB']==NULL||
	$_POST['FuenteRiesgoC']==NULL||
	$_POST['FuenteRiesgoD']==NULL||
	$_POST['FuenteRiesgoE']==NULL||
	$_POST['FuenteRiesgoF']==NULL||
	$_POST['FuenteRiesgoG']==NULL||
	$_POST['RiesgoAsociadoA']==NULL||
	$_POST['RiesgoAsociadoB']==NULL||
	$_POST['RiesgoAsociadoC']==NULL||
	$_POST['RiesgoAsociadoD']==NULL||
	$_POST['EProbabilidadName']==NULL||
	$_POST['ERiesgosName']==NULL
){
$errors[] = "Campos vacios.";
}else{	
		$ConsecutivoEventoRiesgoValue=$_POST['ConsecutivoEventoRiesgoValue'];
		$EventosdeRiesgoName=$_POST['EventosdeRiesgoName'];
		$ProcesosName=$_POST['ProcesosName'];
		$CargosName=$_POST['CargosName'];
		$ResponsablesName=$_POST['ResponsablesName'];
		$TipoRiesgo=$_POST['TipoRiesgo'];
		$FuenteRiesgoA=$_POST['FuenteRiesgoA'];
		$FuenteRiesgoB=$_POST['FuenteRiesgoB'];
		$FuenteRiesgoC=$_POST['FuenteRiesgoC'];
		$FuenteRiesgoD=$_POST['FuenteRiesgoD'];
		$FuenteRiesgoE=$_POST['FuenteRiesgoE'];
		$FuenteRiesgoF=$_POST['FuenteRiesgoF'];
		$FuenteRiesgoG=$_POST['FuenteRiesgoG'];
		$RiesgoAsociadoA=$_POST['RiesgoAsociadoA'];
		$RiesgoAsociadoB=$_POST['RiesgoAsociadoB'];
		$RiesgoAsociadoC=$_POST['RiesgoAsociadoC'];
		$RiesgoAsociadoD=$_POST['RiesgoAsociadoD'];
		$EProbabilidadName=$_POST['EProbabilidadName'];
		$ERiesgosName=$_POST['ERiesgosName'];
		$CustomerKey=$_SESSION['Keyp'];
		$UserKey=$_SESSION['UserKey'];
		date_default_timezone_set("America/Bogota");
		$EventosdeRiesgoKey=time();
		$DateStamp=date("Y-m-d H:i:s");
		$EventoRiesgoStatus='1';

		$sql="INSERT INTO GestiondeRiesgoSarlaft (ConsecutivoEventoRiesgoValue, EventosdeRiesgoKey , EventosdeRiesgoName , ProcesosName, CargosName ,ResponsablesName, TipoRiesgo, FuenteRiesgoA, FuenteRiesgoB, FuenteRiesgoC, FuenteRiesgoD, FuenteRiesgoE, FuenteRiesgoF, FuenteRiesgoG, RiesgoAsociadoA, RiesgoAsociadoB, RiesgoAsociadoC, RiesgoAsociadoD, EProbabilidadName, ERiesgosName, EventoRiesgoStatus, CustomerKey, UserKey, DateStamp) VALUES ('".$ConsecutivoEventoRiesgoValue."','".$EventosdeRiesgoKey."','".$EventosdeRiesgoName."','".$ProcesosName."','".$CargosName."','".$ResponsablesName."','".$TipoRiesgo."','".$FuenteRiesgoA."','".$FuenteRiesgoB."','".$FuenteRiesgoC."','".$FuenteRiesgoD."','".$FuenteRiesgoE."','".$FuenteRiesgoF."','".$FuenteRiesgoG."','".$RiesgoAsociadoA."','".$RiesgoAsociadoB."','".$RiesgoAsociadoC."','".$RiesgoAsociadoD."','".$EProbabilidadName."','".$ERiesgosName."','".$EventoRiesgoStatus."','".$CustomerKey."','".$UserKey."','".$DateStamp."')";
		$query = sqlsrv_query($conn,$sql);
    // if product has been added successfully
     if ($query) {
     	echo'<SCRIPT LANGUAGE="javascript">
     	location.href = "./UGR2-F?ERK='.$EventosdeRiesgoKey.'";
     	</SCRIPT>';
    } else {
        $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} 
if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>			