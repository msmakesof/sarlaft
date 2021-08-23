<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
if(function_exists('curl_init')) // Comprobamos si hay soporte para cURL
{
	$url = $urlServicios."api/tratamientos/lista_eve.php?ck=$CustomerKey";
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
		$sel_csc="<select class='form-control' id='trata' name='trata' required>";
		$sel_csc.="<option value=''>Seleccione opción</option>";
		for($i=0; $i<count($datacsc['body']); $i++)
		{				
			$condicsc = "";
			$idcsc = $datacsc['body'][$i]["id"];
			$nombrecsc = trim($datacsc['body'][$i]["TratamientosName"]);
			$ck = trim($datacsc['body'][$i]["CustomerKey"]);
			if( isset($IdItemcsc) && $IdItemcsc != "" && $idcsc == $IdItemcsc ){
				$condicsc = ' selected="selected" ';
			}
			$sel_csc.= '<option value="'. $idcsc .'"'. $condicsc .'>'. $nombrecsc .'</option>';
		}
		$sel_csc.= "</select>";
	}
}
$vtrata = 0;
?>
<table class="table table-bordered" style="width:100% !important" id="tabtra">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addtra" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Tratamientos" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreatra" style="float:right" data-target="#addTratamientoModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Tratamientos" style="color:orange; cursor:pointer"></i>
			</a>			
		</td>
		<td style="width:80%"><label>Tratamientos</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<tbody id="tabtrabody">
	<?php 
		$getConnectionCli2 = new Database();
		$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);
		$query = sqlsrv_query($conn,"SELECT ETRA_Id, ETRA_NumTratamiento, ETRA_IdEventoRiesgo, ETRA_IdTratamiento, ETRA_Status, ETRA_Prioridad, ETRA_FechaInicio, ETRA_FechaFinal, ETRA_FechaSeguimiento, ETRA_IdPlan FROM ETRA_Tratamientos WHERE ETRA_IdEventoRiesgo=".$IdEvento);
		{
			if ( $query === false)
			{
				die(print_r(sqlsrv_errors(), true));
			}						
			while( $row = sqlsrv_fetch_array( $query, SQLSRV_FETCH_ASSOC) ) {
				$id=$row['ETRA_Id'];
				$NumTratamiento=trim($row['ETRA_NumTratamiento']);
				$IdEventoRiesgo=trim($row['ETRA_IdEventoRiesgo']);
				$IdTratamiento=trim($row['ETRA_IdTratamiento']);
				$Status=trim($row['ETRA_Status']);
				$IdPrioridad=trim($row['ETRA_Prioridad']);
				$FechaInicio=$row['ETRA_FechaInicio'];
				$FechaInicio=date_format($FechaInicio, 'Y-m-d');
				$FechaFinal=$row['ETRA_FechaFinal'];
				$FechaFinal=date_format($FechaFinal, 'Y-m-d');
				$FechaSeguimiento=$row['ETRA_FechaSeguimiento'];
				$FechaSeguimiento=date_format($FechaSeguimiento, 'Y-m-d');
				$IdPlan=trim($row['ETRA_IdPlan']);
		?>			
				<tr id="TRA-<?php echo $IdEvento; ?>">
					<td colspan="3">
						<table id="tratainterna" style="width:100%">
							<tr>
								<td  style="width:100%"><br>
								<div style="clear:both; width:100%"> 
								<select class="form-control tiporie" id="tratamiento<?php echo $IdEvento; ?>" name="tratamiento<?php echo $IdEvento; ?>" onChange="fnTrata(tratamiento<?php echo $IdEvento; ?>,this.options[this.selectedIndex].value)">
									<option value=''>Seleccione</option>
									<?php 
									$sqlmov=sqlsrv_query($conn,"SELECT id, TratamientosName FROM TratamientosSarlaft WHERE CustomerKey='".$CustomerKey."' Order BY TratamientosName");
									if ( $sqlmov === false)
									{
										die(print_r(sqlsrv_errors(), true));
									}
									while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
										$condicontrol = "";
										$TratamientoId = trim($row['id']);
										$Nombre = trim($row['TratamientosName']);

										if( isset($TratamientoId) && $TratamientoId != "" && $TratamientoId == $IdTratamiento ){
											$condicontrol = ' selected="selected" ';
										}
									?>
										<option value="<?php echo $TratamientoId ;?>" <?php echo  $condicontrol; ?>><?php echo $Nombre; ?></option>
									<?php
									}
									?>
								</select><br>
								</div>
								<div style="float:left; width:13%; text-align:center">Estatus</div>
								<div style="float:left; width:13%; text-align:center">Prioridad</div>
								<div style="float:left; width:17%; text-align:center">Fecha Inicial</div>
								<div style="float:left; width:17%; text-align:center">Fecha Final</div>
								<div style="float:left; width:17%; text-align:center">Fecha Seguimiento</div>
								<div style="float:left; width:23%; text-align:center">Plan Acción</div>
								<div style="clear:both; width:100%"> </div>
								<div style="float:left; width:13%; text-align:center">
									<select class="tratastatus" id="tratastatus<?php echo $IdEvento; ?>" name="tratastatus<?php echo $IdEvento; ?>" onChange="fnTrata(tratastatus<?php echo $IdEvento; ?>,this.options[this.selectedIndex].value)">
										<option value="" <?php if($Status==""){ echo ' selected="selected" ';} else{ echo "";} ?>>Seleccione</option>
										<option value="1" <?php if($Status=="1"){ echo ' selected="selected" ';} else{ echo "";} ?>>Registrado</option>
										<option value="2" <?php if($Status=="2"){ echo ' selected="selected" ';} else{ echo "";} ?>>Diferido</option>
										<option value="3" <?php if($Status=="3"){ echo ' selected="selected" ';} else{ echo "";} ?>>Corregido</option>
									</select>
								</div>
								<div style="float:left; width:13%; text-align:center">
									<select class="tratapriori" id="tratapriori<?php echo $IdEvento; ?>" name="tratapriori<?php echo $IdEvento; ?>" onChange="fnTrata(tratapriori<?php echo $IdEvento; ?>,this.options[this.selectedIndex].value)">
										<option value="" <?php if($IdPrioridad==""){ echo ' selected="selected" ';} else{ echo "";} ?>>Seleccione</option>
										<option value="1" <?php if($IdPrioridad=="1"){ echo ' selected="selected" ';} else{ echo "";} ?>>Alto</option>
										<option value="2" <?php if($IdPrioridad=="2"){ echo ' selected="selected" ';} else{ echo "";} ?>>Medio</option>
										<option value="3" <?php if($IdPrioridad=="3"){ echo ' selected="selected" ';} else{ echo "";} ?>>Bajo</option>
									</select>
								</div>
								<div style="float:left; width:17%; text-align:center">
									<input type="date" value="<?php echo $FechaInicio; ?>" class="input-sm tratafecini" id="tratafecini<?php echo $IdEvento; ?>" name="tratafecini<?php echo $IdEvento; ?>" onblur="fnTrata(tratafecini<?php echo $IdEvento; ?>,this.value)" size="10" maxlength="10" style="width: 144px; fontSize:12px"/>
								</div>
								<div style="float:left; width:17%; text-align:center">
									<input type="date" class="input-sm tratafecfin" id="tratafecfin<?php echo $IdEvento; ?>" name="tratafecfin<?php echo $IdEvento; ?>" onblur="fnTrata(tratafecfin<?php echo $IdEvento; ?>,this.value)" size="10" maxlength="10" style="width:144px; fontSize:12px" value="<?php echo $FechaFinal; ?>"/>
								</div>
								<div style="float:left; width:17%; text-align:center">
									<input type="date" class="input-sm tratafecseg" id="tratafecseg<?php echo $IdEvento; ?>" name id="tratafecseg<?php echo $IdEvento; ?>" onblur="fnTrata(tratafecseg<?php echo $IdEvento; ?>,this.value)" size="10" maxlength="10" style="width:144px; fontSize:12px" value="<?php echo $FechaSeguimiento; ?>"/>
								</div>
								<div style="float:left; width:23%; text-align:center">
									<select class="trataplan" id="trataplanes<?php echo $IdEvento; ?>" name="trataplanes<?php echo $IdEvento; ?>" onChange="fnTrata(trataplanes<?php echo $IdEvento; ?>,this.options[this.selectedIndex].value)" style="width:180px">
										<option value=''>Seleccione</option>
										<?php
										$sqlmov=sqlsrv_query($conn,"SELECT id, PlanesName FROM PlanesSarlaft WHERE CustomerKey='".$CustomerKey."' Order BY PlanesName");
										if ( $sqlmov === false)
										{
											die(print_r(sqlsrv_errors(), true));
										}
										while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
											$condicontrol = "";
											$PlanesId = trim($row['id']);
											$Nombre = trim($row['PlanesName']);

											if( isset($PlanesId) && $PlanesId != "" && $PlanesId == $IdPlan ){
												$condicontrol = ' selected="selected" ';
											}
										?>
											<option value="<?php echo $PlanesId ;?>" <?php echo  $condicontrol; ?>><?php echo $Nombre; ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</tr>
						</table>
						<div class="delete" style="width:10%; float:right; text-align:center"><i class="fas fa-trash" style="color:red; cursor:pointer"></i></div>
					</td>
				</tr>
		<?php
			}
		}
	?>
	</tbody>
</table>