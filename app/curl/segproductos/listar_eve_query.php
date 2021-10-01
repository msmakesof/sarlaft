<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/segproductos/lista_eve.php?ck=$CustomerKey";
	////echo "url...$url<br>";
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
	$datadeb = json_decode($mestado, true);	
	
	$json_errors = array(
		JSON_ERROR_NONE => 'No se ha producido ningún error',
		JSON_ERROR_DEPTH => 'Maxima profundidad de pila ha sido excedida',
		JSON_ERROR_CTRL_CHAR => 'Error de carácter de control, posiblemente codificado incorrectamente',
		JSON_ERROR_SYNTAX => 'Error de Sintaxis',
	);
	foreach($datadeb as $key => $row) {}
	
	if( $key == "message")
	{
		echo $datadeb["message"];
	}
	else
	{
		$IdItemcsc="";
		$sel_deb="<select class='form-control' id='segproductos' name='segproductos' required>";
		$sel_deb.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datadeb['body']); $i++)
		{				
			$condideb = "";
			$idcsc = $datadeb['body'][$i]["id"];
			$nombrecsc = trim($datadeb['body'][$i]["SegProductosName"]);
			$ck = trim($datadeb['body'][$i]["CustomerKey"]);
			$cuasak = trim($datadeb['body'][$i]["UserKey"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condideb = ' selected="selected" ';
			}
			$sel_deb.= '<option value="'. $idcsc .'"'. $condideb .'>'. $nombrecsc .'</option>';
		}
		$sel_deb.= "</select>";
	}
}
$vcausas = 0;
?>
<table class="table table-bordered" style="width:100% !important" id="tabspr">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addspr" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Segmento Producto" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreadeb" style="float:right" data-target="#addSegProductosModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Segmento Producto" style="color:orange; cursor:pointer"></i>
			</a>
		</td>
		<td style="width:80%"><label>Segmento Producto</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabsprbody">
	<?php 
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		$query = sqlsrv_query($conn,"SELECT ESPR_Id, ESPR_IdEventoRiesgo, ESPR_IdSegmentoProducto FROM ESPR_SegmentoProductos WHERE ESPR_IdEventoRiesgo=".$IdEvento);
		{
			if ( $query === false)
			{
				die(print_r(sqlsrv_errors(), true));
			}						
			while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
				$id=$row['ESPR_Id'];
				$IdSegmentoProducto=trim($row['ESPR_IdSegmentoProducto']);
		?>
			<tr id="SPR<?php echo $IdSegmentoProducto; ?>">
				<td style="width:10%"></td>
				<td style="width:80%">
				<select class="form-control segproductos" id="segproductos<?php echo $IdSegmentoProducto; ?>" name="segproductos<?php echo $IdSegmentoProducto; ?>" onChange="fxSP(this.options[this.selectedIndex].value, <?php echo $IdSegmentoProducto; ?>)">
					<option value=''>Seleccione</option>
					<?php 
					$sqlmov=sqlsrv_query($conn,"SELECT id, SegProductosName FROM SegProductosSarlaft WHERE CustomerKey='".$CustomerKey."' ORDER BY SegProductosName");
					if ( $sqlmov === false)
					{
						die(print_r(sqlsrv_errors(), true));
					}
					while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
						$condicontrol = "";
						$SegmentoProductoId = trim($row['id']);
						$Nombre = trim($row['SegProductosName']);

						if( isset($SegmentoProductoId) && $SegmentoProductoId != "" && $SegmentoProductoId == $IdSegmentoProducto ){
							$condicontrol = ' selected="selected" ';
						}
					?>
						<option value="<?php echo $SegmentoProductoId ;?>" <?php echo  $condicontrol; ?>><?php echo $Nombre; ?></option>
					<?php
					}
					?>
				</select>
				</td>
				<td style="width:10%">
					<div class="delete" onClick="deletedeUpd(<?php echo $IdSegmentoProducto; ?>,<?php echo $IdEvento; ?>)">
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