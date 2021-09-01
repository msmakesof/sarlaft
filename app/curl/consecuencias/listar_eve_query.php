<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/consecuencias/lista_eve.php?ck=$CustomerKey";
	//echo "url...$url<br>";
	$resultado="";
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
	$datacsc = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datacsc as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datacsc["message"];
	}
	else
	{
		$IdItemcsc="";
		$sel_csc="<select class='form-control' id='consec' name='consec' autofocus required>";
		$sel_csc.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc = "";
			$idcsc = $datacsc['body'][$i]["id"];
			$nombrecsc = trim($datacsc['body'][$i]["ConsecuenciasName"]);
			$ck = trim($datacsc['body'][$i]["CustomerKey"]);
			$cuasak = trim($datacsc['body'][$i]["UserKey"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condicsc = ' selected="selected" ';
			}
			$sel_csc.= '<option value="'. $idcsc .'"'. $condicsc .'>'. $nombrecsc .'</option>';
		}
		$sel_csc.= "</select>";
	}
}
$vconsec = 0;
?>
<table class="table table-bordered" style="width:100% !important" id="tabcon">
	<thead>
		<tr>
			<td style="width:10%">
				<div id="addcon" style="float:left">
					<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Consecuencia" style="color:green; cursor:pointer"></i>
				</div>

				<a href="#" id="mcreacon" style="float:right" data-target="#addConsecuenciaModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
					<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Consecuencia" style="color:orange; cursor:pointer"></i>
				</a>		
			</td>
			<td style="width:80%"><label>Consecuencia</label></td>
			<td style="width:10%"></td>
		</tr>
	</thead>
	<tbody id="tabconbody">
	<?php 
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		$query = sqlsrv_query($conn,"SELECT ECON_Id, ECON_IdEventoRiesgo, ECON_IdConsecuencia FROM ECON_Consecuencias WHERE ECON_IdEventoRiesgo=".$IdEvento);
		{
			if ( $query === false)
			{
				die(print_r(sqlsrv_errors(), true));
			}						
			while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
				$id=$row['ECON_Id'];
				$IdConsecuencia=trim($row['ECON_IdConsecuencia']);
		?>
			<tr id="CON<?php echo $IdConsecuencia; ?>">
				<td style="width:10%"></td>
				<td style="width:80%">
					<select class="form-control consec" id="consec<?php echo $IdConsecuencia; ?>" name="consec<?php echo $IdConsecuencia; ?>" onChange="fxCO(this.options[this.selectedIndex].value, <?php echo $IdConsecuencia; ?>") autofocus>
						<option value=''>Seleccione</option>
						<?php 
						$sqlmov=sqlsrv_query($conn,"SELECT id, ConsecuenciasName FROM ConsecuenciasSarlaft WHERE CustomerKey='".$CustomerKey."' Order BY ConsecuenciasName");
						if ( $sqlmov === false)
						{
							die(print_r(sqlsrv_errors(), true));
						}
						while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
							$condicontrol = "";
							$ConsecuenciasId = trim($row['id']);
							$Nombre = trim($row['ConsecuenciasName']);

							if( isset($IdConsecuencia) && $IdConsecuencia != "" && $IdConsecuencia == $ConsecuenciasId ){
								$condicontrol = ' selected="selected" ';
							}
						?>
							<option value="<?php echo $ConsecuenciasId ;?>" <?php echo  $condicontrol; ?>><?php echo $Nombre; ?></option>
						<?php
						}
						?>
					</select>
				</td>
				<td style="width:10%">
					<div class="delete" onClick="deletecoUpd(<?php echo $IdConsecuencia; ?>,<?php echo $IdEvento; ?>)">
						<i class="fas fa-trash" style="color:red; cursor:pointer"></i>
					</div>
				</td>
			</tr>
		<?php
			}
		}
	?>
	</tbody>
</table>