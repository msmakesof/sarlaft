<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/riesgoasociado/lista_eve.php?ck=$CustomerKey";
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
	$datafr = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datafr as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datafr["message"];
	}
	else
	{		
		/// Para pintar Tipo Riesgo   <i class='fas fa-plus-circle' id='itr' style='cursor: pointer'></i>
		if( $datafr["itemCount"] > 0)
		{			
			$IdItem = "";
			$sel_fr="<select class='form-control' id='ra' name='ra' required>";
			$sel_fr.="<option value=''>Seleccione opción</option>";			
			for($i=0; $i<count($datafr['body']); $i++)
			{				
				$condi = "";
				$id = $datafr['body'][$i]["RIA_IdRiesgoAsociado"];
				$nombre = trim($datafr['body'][$i]["RIA_Nombre"]);
				if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
					$condi = ' selected="selected" ';
				}
				$sel_fr.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
			}
			$sel_fr.= '</select>';				
		}
	}
}		
?>
<table class="table table-bordered" style="width:100% !important" id="tabria">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addiria" style="float:left">
				<i class="fas fa-plus-circle" data-toggle="tooltip" title="Adicionar Causa" style="color:green"></i>
			</div>
			<a href="#" id="zcreacau" style="float:right" data-target="#addRIAModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Causa" style="color:orange; cursor:pointer"></i>
			</a>			
		</td>
		<td style="width:80%"><label>Riesgo Asociado</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabriabody">
	<?php 
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		$query = sqlsrv_query($conn,"SELECT ERIA_Id, ERIA_IdEventoRiesgo, ERIA_IdRiesgoAsociado FROM ERIA_RiesgoAsociado WHERE ERIA_IdEventoRiesgo=".$IdEvento);
		{
			if ( $query === false)
			{
				die(print_r(sqlsrv_errors(), true));
			}						
			while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
				$id=$row['ERIA_Id'];
				$IdRiesgoAsociado=trim($row['ERIA_IdRiesgoAsociado']);
		?>
			<tr id="RIA<?php echo $IdRiesgoAsociado; ?>">
				<td style="width:10%"></td>
				<td style="width:80%">
				<select class="form-control ria" id="ra<?php echo $IdRiesgoAsociado; ?>" name="ra<?php echo $IdRiesgoAsociado; ?>" onChange="fxRA(this.options[this.selectedIndex].value, <?php echo $IdRiesgoAsociado; ?>)">
					<option value=''>Seleccione</option>
					<?php 
					$sqlmov=sqlsrv_query($conn,"SELECT RIA_IdRiesgoAsociado, RIA_Nombre FROM RIA_RiesgoAsociado WHERE RIA_CustomerKey='".$CustomerKey."' ORDER BY RIA_Nombre");
					if ( $sqlmov === false)
					{
						die(print_r(sqlsrv_errors(), true));
					}
					while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
						$condicontrol = "";
						$RiesgoAsociadoId = trim($row['RIA_IdRiesgoAsociado']);
						$Nombre = trim($row['RIA_Nombre']);

						if( isset($RiesgoAsociadoId) && $RiesgoAsociadoId != "" && $RiesgoAsociadoId == $IdRiesgoAsociado ){
							$condicontrol = ' selected="selected" ';
						}
					?>
						<option value="<?php echo $RiesgoAsociadoId ;?>" <?php echo  $condicontrol; ?>><?php echo $Nombre; ?></option>
					<?php
					}
					?>
				</select>
				</td>
				<td style="width:10%">
					<div class="delete" onClick="deleteraUpd(<?php echo $IdRiesgoAsociado; ?>,<?php echo $IdEvento; ?>)">
						<i class="fas fa-trash" style="color:red; cursor:pointer"></i>
					</div>
				</td>
			</tr>
		<?php
			}
		}
	?>
	</tbody>
	<!--
	<tr>
		<td style="width:10%">&nbsp;</td>
		<td><?php echo $sel_fr; ?></td>	
	</tr> -->
</table>