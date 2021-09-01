<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/tiposriesgo/lista_eve.php?ck=$CustomerKey";
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
	$datatr = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	
	foreach($datatr as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datatr["message"];
	}
	else
	{		
		/// Para pintar Tipo Riesgo   <i class='fas fa-plus-circle' id='itr' style='cursor: pointer'></i>
		if( $datatr["itemCount"] > 0)
		{			
			$IdItem = "";
			$sel_tr="<select class='form-control' id='tr' name='tr' required>";
			$sel_tr.="<option value=''>Seleccione opción</option>";			
			for($i=0; $i<count($datatr['body']); $i++)
			{				
				$condi = "";
				$id = $datatr['body'][$i]["TIR_IdTipoRiesgo"];
				$nombre = trim($datatr['body'][$i]["TIR_Nombre"]);
				if( isset($IdItem) && $IdItem != "" && $id == $IdItem ){
					$condi = ' selected="selected" ';
				}
				$sel_tr.= '<option value="'. $id .'"'. $condi .'>'. $nombre .'</option>';
			}
			$sel_tr.= '</select>';				
		}
	}
}		
?>
<table class="table table-bordered" style="width:100% !important" id="tabtir">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addtir" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Tipo Riesgo" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreatir" style="float:right" data-target="#addTipoRiesgoModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Tipo Riesgo" style="color:orange; cursor:pointer"></i>
			</a>					
		</td>
		<td style="width:80%"><label>Tipo Riesgo</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabtirbody">
		<?php 
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		$query = sqlsrv_query($conn,"SELECT ETIR_Id, ETIR_IdEventoRiesgo, ETIR_IdTipoRiesgo FROM ETIR_TipoRiesgo WHERE ETIR_IdEventoRiesgo=".$IdEvento);
		{
			if ( $query === false)
			{
				die(print_r(sqlsrv_errors(), true));
			}						
			while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
				$id=$row['ETIR_Id'];
				$IdTipoRiesgo=trim($row['ETIR_IdTipoRiesgo']);
		?>
			<tr id="TIR<?php echo $IdTipoRiesgo; ?>">
				<td style="width:10%"></td>
				<td style="width:80%">
				<select class="form-control tiporie" id="tr<?php echo $IdTipoRiesgo; ?>" name="tr<?php echo $IdTipoRiesgo; ?>" onChange="fxTR(this.options[this.selectedIndex].value, <?php echo $IdTipoRiesgo; ?>)">
					<option value=''>Seleccione</option>
					<?php 
					$sqlmov=sqlsrv_query($conn,"SELECT TIR_IdTipoRiesgo, TIR_Nombre FROM TIR_TipoRiesgo WHERE TIR_CustomerKey='".$CustomerKey."' ORDER BY TIR_Nombre");
					if ( $sqlmov === false)
					{
						die(print_r(sqlsrv_errors(), true));
					}
					while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
						$condicontrol = "";
						$TipoRiesgoId = trim($row['TIR_IdTipoRiesgo']);
						$Nombre = trim($row['TIR_Nombre']);

						if( isset($IdTipoRiesgo) && $IdTipoRiesgo != "" && $TipoRiesgoId == $IdTipoRiesgo ){
							$condicontrol = ' selected="selected" ';
						}
					?>
						<option value="<?php echo $TipoRiesgoId ;?>" <?php echo  $condicontrol; ?>><?php echo $Nombre; ?></option>
					<?php
					}
					?>
				</select>
				</td>
				<td style="width:10%">
					<div class="delete" onClick="deletetrUpd(<?php echo $IdTipoRiesgo; ?>,<?php echo $IdEvento; ?>)" >
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