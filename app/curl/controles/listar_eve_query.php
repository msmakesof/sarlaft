<?php
//include 'ajax/is_logged.php';
// mks 20210516  verificar cUrl
require_once '../config/dbx.php';
$getUrl = new Database();
$urlServicios = $getUrl->getUrl();
/////echo "ck....$CustomerKey";
//echo "$IdEvento   -  $CustomerKey  <br>";
?>
<table class="table table-bordered" style="width:100% !important" id="tabctr">
	<thead>
	<tr>
		<td style="width:10%">
			<div id="addctr" style="float:left">
				<i class="fas fa-plus-circle fa-1x" data-toggle="tooltip" title="Adicionar Controles" style="color:green; cursor:pointer"></i>
			</div>

			<a href="#" id="mcreactr" style="float:right" data-target="#addControlModal" data-toggle="modal" data-ck="<?php echo $CustomerKey;?>">
				<i class="fas fa-file-alt fa-1x" data-toggle="tooltip" title="Crear Controles" style="color:orange; cursor:pointer"></i>
			</a>			
		</td>
		<td style="width:80%"><label>Controles</label></td>
		<td style="width:10%"></td>
	</tr>
	</thead>
	<?php
$getConnectionCli2 = new Database();
$conn = $getConnectionCli2->getConnectionCli2($CustomerKey);

////$query = "SELECT ECTR_Id, ECTR_IdControl, ECTR_NumControl, ECTR_IdPropietario, ECTR_IdEjecutor, ECTR_IdEfectividad, ECTR_IdFrecuencia, ECTR_IdCategoria,ECTR_IdRealizado, ECTR_IdDocumentado, ECTR_IdAplicado, ECTR_IdEfectivo, ECTR_IdEvaluado, ECTR_IdEventoMRC, ECTR_CustomerKey, ECTR_UserKey FROM ECTR_Controles WHERE ECTR_IdEventoMRC=".$IdEvento." AND ECTR_CustomerKey='".$CustomerKey."'";

$query = "SELECT ECTR_Id, ECTR_IdControl, ECTR_NumControl, ECTR_IdPropietario, ECTR_IdEjecutor, ECTR_IdEfectividad, ECTR_IdFrecuencia, ECTR_IdCategoria,ECTR_IdRealizado, ECTR_IdDocumentado, ECTR_IdAplicado, ECTR_IdEfectivo, ECTR_IdEvaluado, ECTR_IdEventoMRC, ECTR_CustomerKey, ECTR_UserKey FROM ECTR_Controles JOIN MOV_MatrizControl ON MOV_IdEventoMRC = ECTR_IdEventoMRC AND MOV_NumControl = ECTR_NumControl AND MOV_Estado = 'G' WHERE ECTR_IdEventoMRC=".$IdEvento." AND ECTR_CustomerKey='".$CustomerKey."'";
echo $query;
$stmt = sqlsrv_query($conn,$query);

if ( $stmt === false)
{
	die(print_r(sqlsrv_errors(), true));
}
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
	$id=$row['ECTR_Id'];
	$IdControl=$row['ECTR_IdControl'];
	$NumControl=trim($row['ECTR_NumControl']);
	$IdPropietario=trim($row['ECTR_IdPropietario']);
	$IdEjecutor=trim($row['ECTR_IdEjecutor']);
	$IdEfectividad=$row['ECTR_IdEfectividad'];
	$IdFrecuencia=$row['ECTR_IdFrecuencia'];
	$IdCategoria=trim($row['ECTR_IdCategoria']);
	$IdRealizado=trim($row['ECTR_IdRealizado']);
	$IdDocumentado=$row['ECTR_IdDocumentado'];
	$IdAplicado=$row['ECTR_IdAplicado'];
	$IdEfectivo=$row['ECTR_IdEfectivo'];
	$IdEvaluado=$row['ECTR_IdEvaluado'];
	$IdEventoMRC=trim($row['ECTR_IdEventoMRC']);
	$CustomerKey=trim($row['ECTR_CustomerKey']);
	
	$parDelete = "N-".$NumControl;
	/*$UserKey=trim($row['ECTR_UserKey']);*/
	echo "idFrecuencia......$IdFrecuencia <br>";
?>		
	<tr id="CTR-<?php echo $NumControl; ?>">
		<td colspan="3">			
			<table id="controlinterna" style="width:100%">
				<tr>
					<td  style="width:100%">
						<div style="width:100%; float:left"> <?php //echo $IdControl; ?>
							<select class="form-control control" id="selcont<?php echo $NumControl; ?>" name="selcont<?php echo $NumControl; ?>" onChange="fnselCont(selcont<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="" style="color: red">Seleccione Opción</option>
								<?php
								$sqlmov=sqlsrv_query($conn,"SELECT id, ControlesName FROM ControlesSarlaft WHERE CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$idControlSarlaft = $row['id'];
									$ControlName = trim($row['ControlesName']);

									if( isset($IdControl) && $IdControl != "" && trim($idControlSarlaft) == trim($IdControl) ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $idControlSarlaft ;?>" <?php echo  $condicontrol; ?>><?php echo $ControlName; ?></option>
								<?php
								}
								?>
							</select>
							<br>
							<div style="clear:both; width:100%; text-align:center"></div>
							<div style="float:left; width:17%; text-align:center">Propietario</div>
							<div style="float:left; width:17%; text-align:center">Ejecutor</div>
							<div style="float:left; width:17%; text-align:center">Efectividad</div>
							<div style="float:left; width:17%; text-align:center">Frecuencia</div>
							<div style="float:left; width:17%; text-align:center">Categoría</div>
							<div style="float:left; width:15%; text-align:center">Realizado</div>
							<div style="clear:both; width:100%"> </div>
							<div style="float:left; width:17%; text-align:center">
								<select class="ctrpropietario" id="selprop<?php echo $NumControl; ?>" name="selprop<?php echo $NumControl; ?>" onChange="fnselProp(selprop<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php
								$sqlmov=sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$ResponsablesId = trim($row['ResponsablesId']);
									$ResponsablesName = trim($row['ResponsablesName']);

									if( isset($IdPropietario) && $IdPropietario != "" && $ResponsablesId == $IdPropietario ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $ResponsablesId ;?>" <?php echo  $condicontrol; ?>><?php echo $ResponsablesName; ?></option>
								<?php } ?>
								</select>
							</div>

							<div style="float:left; width:17%; text-align:center">
								<select class="ctrejecutor" id="selejec<?php echo $NumControl; ?>" name="selejec<?php echo $NumControl; ?>" onChange="fnselEjec(selejec<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT ResponsablesId, ResponsablesName FROM ResponsablesSarlaft WHERE CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$EjecutorId = trim($row['ResponsablesId']);
									$EjecutorName = trim($row['ResponsablesName']);

									if( isset($IdEjecutor) && $IdEjecutor != "" && $EjecutorId == $IdEjecutor ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $EjecutorId ;?>" <?php echo  $condicontrol; ?>><?php echo $EjecutorName; ?></option>
								<?php } ?>
								</select>
							</div>

							<div style="float:left; width:17%; text-align:center">
								<select class="ctrefectividad" id="selefct<?php echo $NumControl; ?>" name="selefct<?php echo $NumControl; ?>" onChange="fnselEfec(selefct<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT EFE_IdEfectividad, EFE_Nombre FROM EFE_Efectividad WHERE EFE_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$EfectividadId = trim($row['EFE_IdEfectividad']);
									$EfectividadName = trim($row['EFE_Nombre']);

									if( isset($EfectividadId) && $EfectividadId != "" && $IdEfectividad == $EfectividadId ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $EfectividadId ;?>" <?php echo  $condicontrol; ?>><?php echo $EfectividadName; ?></option>
								<?php } ?>
								</select>
							</div>

							<div style="float:left; width:17%; text-align:center">
								<select class="ctrfrecuencia" id="selfrec<?php echo $NumControl; ?>" name="selfrec<?php echo $NumControl; ?>" onChange="fnselFrec(selfrec<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT FRE_IdFrecuencia, FRE_Nombre FROM FRE_Frecuencia WHERE FRE_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$FrecuenciaId = trim($row['FRE_IdFrecuencia']);
									$FrecuenciaName = trim($row['FRE_Nombre']);

									if( isset($IdFrecuencia) && $IdFrecuencia != "" && $FrecuenciaId == $IdFrecuencia ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $FrecuenciaId ;?>" <?php echo  $condicontrol; ?>><?php echo $FrecuenciaName; ?></option>
								<?php } ?>
								</select>
							</div>

							<div style="float:left; width:15%; text-align:center">
								<select class="ctrcategoria" id="ctrcategoria<?php echo $NumControl; ?>" name="ctrcategoria<?php echo $NumControl; ?>" onChange="fnCategoria(this)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT CAT_IdCategoria, CAT_Nombre FROM CAT_Categoria WHERE CAT_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$CategoriaId = trim($row['CAT_IdCategoria']);
									$CategoriaId = $CategoriaId.'-'.$NumControl;
									$CategoriaName = trim($row['CAT_Nombre']);

									if( isset($IdCategoria) && $IdCategoria != "" && $CategoriaId == $IdCategoria ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $CategoriaId ;?>" <?php echo $condicontrol; ?>><?php echo $CategoriaName; ?></option>
								<?php } ?>
								</select>
							</div>

							<div style="float:left; width:15%; text-align:center">
								<select class="ctrrealizado" id="ctrrealizado<?php echo $NumControl; ?>" name="ctrrealizado<?php echo $NumControl; ?>" onChange="fnRealizado(this.options[this.selectedIndex].value)">
									<option value="">Seleccione</option>
									<option value="S-<?php echo $NumControl; ?>" <?php if( $IdRealizado == "S"){ echo ' selected="selected" ';} else{ echo ""; }?>>
										Si</option>
									<option value="N-<?php echo $NumControl; ?>" <?php if( $IdRealizado == "N"){ echo ' selected="selected" ';} else{ echo ""; }?>>
										No</option>								
								</select>
							</div>

							<div style="clear:both; width:100%">&nbsp;</div>
							<div style="clear:both; width:100%; text-align:center; background-color: #D3D3D3;"> Calificación del Control </div>
							<div style="float:left; width:15%; text-align:center">Documentado</div>
							<div style="float:left; width:15%; text-align:center">Aplicado</div>
							<div style="float:left; width:15%; text-align:center">Efectivo</div>
							<div style="float:left; width:15%; text-align:center">Evaluado</div>
							<div style="float:left; width:17%; background-color: #D3D3D3; text-align:center">Promedio</div>
							<div style="float:left; width:23%; background-color: #D3D3D3; text-align:center">Calificación</div>
							<div style="clear:both; width:100%"> </div>

							<div style="float:left; width:15%; text-align:center">
								<select class="seldocum" id="seldocum<?php echo $NumControl; ?>" name="seldocum<?php echo $NumControl; ?>" onChange="fxselDocum(seldocum<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value=''>Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT ESC_IdEscalaCalificacion, ESC_Valor FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$EscalaCalifId = trim($row['ESC_IdEscalaCalificacion']);
									$Valor = trim($row['ESC_Valor']);

									if( isset($IdDocumentado) && $IdDocumentado != "" && $Valor == $IdDocumentado ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $Valor ;?>" <?php echo  $condicontrol; ?>><?php echo $Valor; ?></option>
								<?php } ?>

								</select>
							</div>

							<div style="float:left; width:15%; text-align:center">
								<select class="selaplica" id="selaplica<?php echo $NumControl; ?>" name="selaplica<?php echo $NumControl; ?>" onChange="fxselAplica(selaplica<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT ESC_IdEscalaCalificacion, ESC_Valor FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$EscalaCalifId = trim($row['ESC_IdEscalaCalificacion']);
									$Valor = trim($row['ESC_Valor']);

									if( isset($IdAplicado) && $IdAplicado != "" && $Valor == $IdAplicado ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $Valor ;?>" <?php echo  $condicontrol; ?>><?php echo $Valor; ?></option>
								<?php } ?>

								</select>
							</div>

							<div style="float:left; width:15%; text-align:center">
								<select class="selefec" id="selefec<?php echo $NumControl; ?>" name="selefec<?php echo $NumControl; ?>" onChange="fxselEfec(selefec<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT ESC_IdEscalaCalificacion, ESC_Valor FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$EscalaCalifId = trim($row['ESC_IdEscalaCalificacion']);
									$Valor = trim($row['ESC_Valor']);

									if( isset($IdEfectivo) && $IdEfectivo != "" && $Valor == $IdEfectivo ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $Valor ;?>" <?php echo  $condicontrol; ?>><?php echo $Valor; ?></option>
								<?php } ?>

								</select>
							</div>

							<div style="float:left; width:15%; text-align:center">
								<select class="seleval" id="seleval<?php echo $NumControl; ?>" name="seleval<?php echo $NumControl; ?>" onChange="fxselEval(seleval<?php echo $NumControl; ?>,this.options[this.selectedIndex].value)">
								<option value="">Seleccione</option>
								<?php 
								$sqlmov=sqlsrv_query($conn,"SELECT ESC_IdEscalaCalificacion, ESC_Valor FROM ESC_EscalaCalificacion WHERE ESC_CustomerKey='".$CustomerKey."'");
								if ( $sqlmov === false)
								{
									die(print_r(sqlsrv_errors(), true));
								}
								while( $row = sqlsrv_fetch_array( $sqlmov, SQLSRV_FETCH_ASSOC) ) {
									$condicontrol = "";
									$EscalaCalifId = trim($row['ESC_IdEscalaCalificacion']);
									$Valor = trim($row['ESC_Valor']);

									if( isset($IdEvaluado) && $IdEvaluado != "" && $Valor == $IdEvaluado ){
										$condicontrol = ' selected="selected" ';
									}
								?>
									<option value="<?php echo $Valor ;?>" <?php echo  $condicontrol; ?>><?php echo $Valor; ?></option>
								<?php } ?>

								</select>
							</div>

							<div style="float:left; width:17%; text-align:center !important">
								<?php
								$contar = 0;
								$sumatoria = 0;
								$totpromedio = 0;
								if($IdDocumentado > 0){ $contar++;  $sumatoria += $IdDocumentado; }
								if($IdAplicado > 0){ $contar++; $sumatoria += $IdAplicado;}
								if($IdEfectivo > 0){ $contar++;   $sumatoria += $IdEfectivo;}
								if($IdEvaluado > 0){ $contar++;   $sumatoria += $IdEvaluado;}
								if($contar > 0){
									$totpromedio = $sumatoria/$contar ;								
								}
								$totpromedio = round($totpromedio);
								$totsumatoria = $sumatoria;
								//echo '<script>fxSumar('. $totsumatoria.','.$IdEventoMRC.')</script>';

								/*echo '<script type="text/javascript">
								fxSumar(<?php echo $totsumatoria; ?>, <?php echo $IdEventoMRC; ?>)
								</script>';*/
								?>

								<input type="text" id="promedio<?php echo $NumControl; ?>" maxlength="10" style="background-color: #D3D3D3; text-align:center" value="<?php echo $totsumatoria; ?>" readonly/>
							</div>

							<div style="float:left; width:23%; text-align:center">
								<?php
								$query_cal=sqlsrv_query($conn,"SELECT CAL_IdCalificacion, CAL_Nombre, CAL_Color FROM CAL_Calificacion WHERE CAL_CustomerKey='".$CustomerKey."' AND ". $totsumatoria. " BETWEEN CAL_RangoInicial AND CAL_RangoFinal");
								$regtit=sqlsrv_fetch_array($query_cal);
								$IdCalificacion = trim($regtit['CAL_IdCalificacion']);
								$NombreCalificacion = trim($regtit['CAL_Nombre']);
								$Color = trim($regtit['CAL_Color']);
								?>	
								<input type="text" id="calificacion<?php echo $NumControl; ?>" maxlength="10" style="width:100%; text-align:center; background-color:<?php echo $Color; ?>" value="<?php echo $NombreCalificacion; ?>" readonly/>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<div class="xdelete" style="width:10%; float:right; text-align:center" onClick="deleteCtrl('<?php echo $parDelete;?>',<?php echo $IdEventoMRC;?>)">
				<i class="fas fa-trash" style="color:red; cursor:pointer"></i>
			</div>
		</td>
	</tr>
<?php
	}  // Fin While ppal
?>
</table>
<script>
	var infcontrol = 0;
	var infodocumtxt = 0;
	var infoaplicatxt = 0;
	var infoefectxt = 0;
	var infoevaltxt = 0;
	var totsumatoria = 0;
	var infprop = 0;
	var infejec = 0;
	var infefec = 0;
	var inffrec = 0;

	function fnselCont(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);   //Este es el id de ECTR_Controles ECTR_idControl
		////alert('itemcontrol desde listar_eve_query...'+itemcontrol);
		//Control, este es el id del Control Seleccionado de la tabla ControlesSarlaft
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		////alert('infcontrol...'+infcontrol);
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt);
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);
		infoevaltxt = parseInt(infoevaltxt);
		//alert(infodocum+'  '+infoaplica);
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselProp(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		alert('itemcontrol propietario.....'+itemcontrol);
		alert('propietario...'+itemcontrol);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt);
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);
		infoevaltxt = parseInt(infoevaltxt);
		//alert(infodocum+'  '+infoaplica);
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselEjec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		alert('ejecutor...'+itemcontrol);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt);
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);
		infoevaltxt = parseInt(infoevaltxt);
		//alert(infodocum+'  '+infoaplica);
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselEfec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt);
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);
		infoevaltxt = parseInt(infoevaltxt);
		//alert(infodocum+'  '+infoaplica);
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fnselFrec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt);
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);
		infoevaltxt = parseInt(infoevaltxt);
		//alert(infodocum+'  '+infoaplica);
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)

		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}
	
	function fxselDocum(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(8);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();
	
		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt);
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);
		infoevaltxt = parseInt(infoevaltxt);
		//alert(infodocum+'  '+infoaplica);
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		var totsumatoria = sumatoria;
		fxSumar(totsumatoria, itemcontrol)
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}
	
	function fxselAplica(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(9);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt); 
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);  
		infoevaltxt = parseInt(infoevaltxt); 
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
		var totsumatoria = sumatoria;
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		fxSumar(totsumatoria, itemcontrol)
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fxselEfec(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt); 
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);  
		infoevaltxt = parseInt(infoevaltxt); 
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
		var totsumatoria = sumatoria;
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		fxSumar(totsumatoria, itemcontrol)	
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}
	
	function fxselEval(ParId, ParReg){
		var itemcontrol = ParId.name;
		itemcontrol = itemcontrol.substr(7);
		//Control
		infcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
		//Propietario
		infprop = $("#selprop"+itemcontrol).children("option:selected").val();
		//Ejecutor
		infejec = $("#selejec"+itemcontrol).children("option:selected").val();
		//Efectividad
		infefec = $("#selefct"+itemcontrol).children("option:selected").val();
		//Frecuencia
		inffrec = $("#selfrec"+itemcontrol).children("option:selected").val();

		var infoeval = $("#seleval"+itemcontrol).children("option:selected").val();
		infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();
		
		var infodocum = $("#seldocum"+itemcontrol).children("option:selected").val();
		infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
		
		var infoaplica = $("#selaplica"+itemcontrol).children("option:selected").val();
		infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();
		
		var infoefec = $("#selefec"+itemcontrol).children("option:selected").val();
		infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();
		
		infodocumtxt = parseInt(infodocumtxt); 
		infoaplicatxt =parseInt(infoaplicatxt);
		infoefectxt = parseInt(infoefectxt);  
		infoevaltxt = parseInt(infoevaltxt);  
		var contar = 0;
		var sumatoria = 0;
		var totpromedio = 0;
		if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt;  }
		if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt; }
		if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;   }
		if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;   }
		var totsumatoria = sumatoria;
		totpromedio = sumatoria/contar ;
		totpromedio = Math.round(totpromedio);
		if( isNaN(totpromedio) ){ totpromedio = "" }
		$("#promedio"+itemcontrol).val( totpromedio )
		fxSumar(totsumatoria, itemcontrol)
		fnRegla_3_4(infodocumtxt,infoaplicatxt,infoefectxt,infoevaltxt,ParReg,infprop,infejec,infefec,inffrec,infcontrol,itemcontrol)
	}

	function fxSumar(parSumar, parIdControl){
		alert(parSumar);	
		let id = "";
		let nombre = "";
		let color = "";
		if (parSumar > 0){
			$.post("../api/calificacion/lista_select.php", {ck: CKCtr, vr: parSumar }, function(data){
				id = data.body[0]["CAL_IdCalificacion"];
				nombre = data.body[0]["CAL_Nombre"];
				color = data.body[0]["CAL_Color"];
				$("#calificacion"+parIdControl).css("background-color", color);
				$("#calificacion"+parIdControl).attr("value", nombre);
				console.log(color);
			})
		}
	}
	
	function deleteCtrl(pValue, eventoriesgo){		
		
		
			//alert('antes pValue...'+pValue);
			moverbolita = pValue;  ////.value;  // S o N
			//alert('moverbolita fnRealizado....'+moverbolita);
			itemcontrol = moverbolita.substr(2);
			//alert('itemontrol desde fnRealizado....'+itemcontrol);
			moverbolita = moverbolita.substr(0,1);
			alert('moverbolita en fnRealizado....'+moverbolita);
			
			////alert('Categoria...'+txtCat);
			// Para la Categoria
			categoria = $("#ctrcategoria"+itemcontrol).children("option:selected").val();
			txtCat = $("#ctrcategoria"+itemcontrol).children("option:selected").text();
			/////alert('txt Categoria......'+txtCat);
			txtCat = txtCat.substr(0,1);
			/////alert('txt Categoria Letra1......'+txtCat);
			if( txtCat == "P" ){  
				//alert('Cat:  mover Abajo');  
				movercols = 0;
				moverfils = 1;
			}
			else if( txtCat == "C" ){  
				//alert('Cat:  mover Izquierda');
				movercols = 1;
				moverfils = 0;
			}
			else if( txtCat == "A" ){ 
				//alert('Cat:  mover Abajo e Izquierda'); 
				movercols = 1;
				moverfils = 1;
			}
			else{
				moverfils = 0;
				movercols = 0;
			}

			//Control
			valcontrol = $("#selcont"+itemcontrol).children("option:selected").val();
			//Propietario
			valprop = $("#selprop"+itemcontrol).children("option:selected").val();
			//Ejecutor
			valejec = $("#selejec"+itemcontrol).children("option:selected").val();
			//Efectividad
			valefect = $("#selefct"+itemcontrol).children("option:selected").val();
			//Frecuencia
			valfrec = $("#selfrec"+itemcontrol).children("option:selected").val();

			var valDoc = 0
			var valApl = 0
			var valEfe = 0
			var valEva = 0
			
			valDoc = $("#seldocum"+itemcontrol).children("option:selected").val();
			if (valDoc == ""){
				valDoc = 0 ;
			}
			else {
				valDoc = parseInt(valDoc);
			}
			infodocumtxt = $("#seldocum"+itemcontrol).children("option:selected").text();
			
			valApl = $("#selaplica"+itemcontrol).children("option:selected").val();
			if (valApl == ""){
				valApl = 0 ;
			}
			else {
				valApl = parseInt(valApl);
			}
			infoaplicatxt = $("#selaplica"+itemcontrol).children("option:selected").text();

			valEfe = $("#selefec"+itemcontrol).children("option:selected").val();
			if (valEfe == ""){
				valEfe = 0 ;
			}
			else {
				valEfe = parseInt(valEfe);
			}
			infoefectxt = $("#selefec"+itemcontrol).children("option:selected").text();

			valEva = $("#seleval"+itemcontrol).children("option:selected").val();
			if (valEva == ""){
				valEva = 0 ;
			}
			else {
				valEva = parseInt(valEva);
			}
			infoevaltxt = $("#seleval"+itemcontrol).children("option:selected").text();

			infodocumtxt = parseInt(infodocumtxt);
			infoaplicatxt =parseInt(infoaplicatxt);
			infoefectxt = parseInt(infoefectxt);
			infoevaltxt = parseInt(infoevaltxt);
			//alert(infodocum+'  '+infoaplica);
			var contar = 0;
			var sumatoria = 0;
			var totpromedio = 0;
			if(infodocumtxt > 0){ contar++;  sumatoria += infodocumtxt; }
			if(infoaplicatxt > 0){ contar++; sumatoria += infoaplicatxt;}
			if(infoefectxt > 0){ contar++;   sumatoria += infoefectxt;}
			if(infoevaltxt > 0){ contar++;   sumatoria += infoevaltxt;}
			totpromedio = sumatoria/contar ;
			totpromedio = Math.round(totpromedio);
			if( isNaN(totpromedio) ){ totpromedio = "" }
			$("#promedio"+itemcontrol).val( totpromedio )
			var totsumatoria = sumatoria;
			fxSumar(totsumatoria, itemcontrol)
			
			let valorAplicado = <?php echo $ValorAplicado; ?>; //10
			let ValorEfectivo = <?php echo $ValorEfectivo; ?>; //10
			let sumaitems = valDoc + valApl + valEfe + valEva;
			alert('sumaitems desde realizado...'+sumaitems);
			
			alert('valDoc...'+valDoc+'   valApl...'+valApl+'   valorAplicado...'+valorAplicado+'   valEfe....'+valEfe+'   ValorEfectivo...'+ValorEfectivo);
			if( valApl >= valorAplicado && valEfe >= ValorEfectivo ){				
				posicionesmover = 1;
				if( sumaitems >= <?php echo $Umbral; ?> ){
					posicionesmover = 2;
				}
			}
			else {
				posicionesmover = 0;
			}
			
			fnMatRiesgo(moverbolita,moverfils,movercols,posicionesmover,itemcontrol,categoria,valDoc,valApl,valEfe,valEva,valprop,valejec,valefect,valfrec,valcontrol)
			
			let nt = pValue.substr(2);
			let er = eventoriesgo
			alert('delete desde control nt...'+nt);	
			let pidValue = "N-"+nt
			$.ajax({
				async: false,
				type: "POST",
				url: "../api/matriz/delete_control.php",
				data:  { 'ck': CKCtr, 'id': nt, 'er': er },
				success: function(datos){
					if( $.trim(datos) == "S" ){
						$("#prob1").trigger('change');
					}
				}
			})
			itemcontrol = nt
			//alert('pValue desde control....'+pidValue);
			$("#CTR-" + nt).remove();
		}
	
	
/* */
 $(document).ready(function(){
	$('#addControlModal').on('show.bs.modal', function (event) {
		$('#ControlesName2').val('')
		setTimeout(function (){
			$('#ControlesName2').focus()
		}, 1000)
	})

	$( "#add_control" ).submit(function( event ) {
		var parametros = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "../ajax/controles/guardar_control.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados").html("Enviando...");
			},
			success: function(datos){
				$('#addControlModal').modal('hide');
				let m= datos.trim()
				let msj = m.substr(0,1);
				let type
				let txt
				if(msj == 'O'){
					type = 'success';
					txt = 'Control ha sido guardado con éxito.';
				}
				else if(msj == 'E'){
					type= 'warning';
					txt = 'En Control Ya existe un Registro grabado con el mismo Nombre.';
				}							
				else if(msj == 'F'){
					type= 'error';
					txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
				}
				else if(msj == 'D'){
					type= 'error';
					txt ='Error Desconocido.';
				}
				else{
					type= 'error';
					txt = 'Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.';
				}
				swal({
					position: 'top-end',
					type: ''+type,
					title: ''+txt,
					showConfirmButton: true,
					timer: 2000
				});
			}
		})
		event.preventDefault();
	})
})

/*$('.delete').off().click(function(e) {
	alert('delete desde consulta');
})*/
</script>	